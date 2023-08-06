<script lang="ts">
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	import EditElement from '$lib/components/molecule/editDiary/EditElement.svelte';
</script>

<AuthenticatedHead title="日記作成" description="日記作成ページ" />
<EditElement />
