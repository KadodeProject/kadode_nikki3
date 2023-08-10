<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import '$lib/styles/readingAssist.css';
	import type { LayoutData } from './$types';
	export let data: LayoutData;

	let assist = false;

	// data.diary_processed.affiliation {end,start,form,lemma}を元に、文字列中のlemma単語に背景色を付ける

	interface HighlightObject {
		start: number;
		end: number;
		form: string;
		lemma: string;
	}
	const highlightText = (text: string, highlightObjects: HighlightObject[]): string => {
		let offset = 0;
		for (const obj of highlightObjects) {
			const before = text.substring(0, obj.start + offset);
			const target = text.substring(obj.start + offset, obj.end + offset);
			const after = text.substring(obj.end + offset);

			// ハイライトの処理
			const highlighted = `<span title="${obj.form}" class="bg-blue rounded-lg" style="padding:1px 1px">${target}</span>`;
			text = before + highlighted + after;

			// <span>タグの追加によるオフセットの更新
			offset += highlighted.length - target.length;
		}
		return text;
	};
	const contentAssist = highlightText(data.content, data.diary_processed.affiliation);
</script>

<AuthenticatedHead title="日記" description="日記作成ページ" />
<h2>
	{data.date}
</h2>
<h2>{data.title}</h2>
<div class="w-full h-1/2 p-4">
	{#if assist}
		<p class="whitespace-pre-wrap">
			<!-- これXSSになるので要検討 -->
			{@html contentAssist}
		</p>
	{:else}
		<p class="whitespace-pre-wrap">
			{data.content}
		</p>
	{/if}
</div>
<a href="/diary/{data.date}/edit" class="text-white bg-brown hover:underline p-2 rounded-full"
	>編集</a
>
<button
	on:click={() => {
		assist = !assist;
	}}
	class="text-white bg-brown hover:underline p-2 rounded-full">アシスト</button
>
<span title="Person">人</span>
