<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
	import OsiraseSentence from '$lib/components/atom/sentence/OsiraseSentence.svelte';
	import type { PageData } from './$types';
	export let data: PageData;
</script>

<GuestHead title="リリースノート" description="かどで日記のリリースノート" />
<PageHeading title="リリースノート" />

<div class="document-center">
	{#each data.response as osirase}
		<OsiraseSentence {osirase} />
	{/each}
</div>
