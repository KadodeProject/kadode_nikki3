<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import type { ArchiveDiaryType } from '$lib/types/Diary';
	import EditDiaryElement from '$src/lib/components/organism/editDiary/EditDiaryElement.svelte';
	export let data: ArchiveDiaryType;
</script>

<AuthenticatedHead title="日記" description="日記作成ページ" />
<EditDiaryElement diary={data} />
