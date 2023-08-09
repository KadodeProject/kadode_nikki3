<script lang="ts">
	import ArchiveDiaryCard from '$lib/components/molecule/showDiary/ArchiveDiaryCard.svelte';
	import type { ArchiveDiaryType } from '$lib/types/Diary';
	import AttributeDateBubble from '$lib/components/atom/showDiary/AttributeDateBubble.svelte';
	export let diaries: ArchiveDiaryType[];
</script>

<div class="flex flex-wrap justify-center space-x-4 itemse-center mb-12">
	{#each diaries as diary}
		<div>
			<AttributeDateBubble dateString={diary.date} />
			<ArchiveDiaryCard {diary} />
		</div>
	{/each}
</div>
