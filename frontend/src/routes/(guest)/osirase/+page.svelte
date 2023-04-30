<script lang="ts">
	import type { PageData } from './$types';
	import OsiraseSentence from '$lib/components/atom/sentence/OsiraseSentence.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
	export let data: PageData;
</script>

<PageHeading title="おしらせ" />
{#each data.data as osirase}
	<OsiraseSentence {osirase} />
{/each}
