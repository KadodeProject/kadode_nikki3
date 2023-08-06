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
	<p>
		{data.content}
	</p>
</div>
