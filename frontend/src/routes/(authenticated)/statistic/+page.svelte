<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import type { PageData } from './$types';
	import WordCountChart from '$src/lib/components/atom/statistic/WordCountChart.svelte';
	export let data: PageData;
	console.log(data);
</script>

<AuthenticatedHead title="統計" description="統計閲覧ページ" />
<WordCountChart data={data.month_words} title="月ごとの文字数" />
