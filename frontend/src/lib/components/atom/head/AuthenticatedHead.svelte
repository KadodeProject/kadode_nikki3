<script lang="ts">
	export let title: string;
	export let description: string;
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
</script>

<GuestHead {title} {description} />

<svelte:head>
	<meta name="robots" content="noindex,nofollow" />
</svelte:head>
