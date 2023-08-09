<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import type { PageData } from './$types';
	export let data: PageData;
</script>

<AuthenticatedHead title="日記" description="日記作成ページ" />
<h2>
	{data.date}
</h2>
<h2>{data.title}</h2>
<div class="w-full h-1/2 p-4">
	<p class="whitespace-pre-wrap">
		{data.content}
	</p>
</div>
<a href="/diary/{data.date}/edit" class="text-white bg-brown hover:underline p-2 rounded-full"
	>編集</a
>
