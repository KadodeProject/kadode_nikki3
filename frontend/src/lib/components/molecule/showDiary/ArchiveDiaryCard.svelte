<script lang="ts">
	import type { ArchiveDiaryType } from '$lib/types/Diary';
	import DateYyyymDddd from '$lib/components/atom/showDiary/DateYYYYMDddd.svelte';
	export let diary: ArchiveDiaryType;
</script>

<a href="/diary/{diary.date}">
	<article class="p-2 w-60 h-80 rounded-xl border border-blue">
		<!-- これは仮 -->
		<DateYyyymDddd dateString={diary.date} />
		<p>{diary.updated_at}</p>
		<h2>{diary.title}</h2>
		<p class="overflow-y-scroll h-60">{diary.content}</p>
	</article>
</a>
