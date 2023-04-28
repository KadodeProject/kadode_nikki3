<script lang="ts">
	import type { PageData } from './$types';
	import AuthenticatedHead from '$lib/components/atom/head/AuthenticatedHead.svelte';
	export let data: PageData;
</script>

<AuthenticatedHead title="ホーム" slug="/home" description="おかえりなさい" />

<p class="text-4xl text-center">
	{data.name}さん！
</p>
