<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import HomeHeading from '$lib/components/atom/heading/HomeHeading.svelte';
	import Mihiraki from '$lib/components/organism/diary/MihirakiDiaries.svelte';
	import RecommendDiaries from '$lib/components/organism/diary/RecommendDiaries.svelte';
	import type { PageData } from './$types';
	export let data: PageData;
</script>

<AuthenticatedHead title="ホーム" description="おかえりなさい" />

<Mihiraki
	zeroDayAgoDiary={data.zeroDayAgoDiary}
	oneDayAgoDiary={data.oneDayAgoDiary}
	twoDayAgoDiary={data.twoDayAgoDiary}
	threeDayAgoDiary={data.threeDayAgoDiary}
/>

<HomeHeading title="最近の傾向" />

<p class="text-center">comming soon</p>

<HomeHeading title="おすすめの日記" />
<RecommendDiaries diaries={data.oldDiaries} />
