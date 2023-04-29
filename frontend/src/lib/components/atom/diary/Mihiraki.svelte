<script lang="ts">
	import type { MihirakiContentType } from '$lib/types/Diary';
	export let zeroDayAgoDiary: MihirakiContentType;
	export let oneDayAgoDiary: MihirakiContentType;
	export let twoDayAgoDiary: MihirakiContentType;
	export let threeDayAgoDiary: MihirakiContentType;
</script>

<article class="border border-brown rounded-3xl">
	<h3 class="text-2xl text-center">今日の日記</h3>
	<p>
		{zeroDayAgoDiary ? zeroDayAgoDiary.content : '日記がありません'}
	</p>
</article>
<!-- 実装がゲキムズなので一旦保留 -->
きのう:{oneDayAgoDiary ? oneDayAgoDiary.title : '日記がありません'}
おととい:{twoDayAgoDiary ? twoDayAgoDiary.title : '日記がありません'}
さきおととい:{threeDayAgoDiary ? threeDayAgoDiary.title : '日記がありません'}
