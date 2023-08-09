<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import CreateDiaryBaseElement from '$src/lib/components/molecule/editDiary/CreateDiaryBaseElement.svelte';
</script>

<AuthenticatedHead title="日記作成" description="日記作成ページ" />
<CreateDiaryBaseElement method="POST" action="" />
