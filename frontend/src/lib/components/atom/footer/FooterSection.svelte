<script lang="ts">
	import type { FooterSectionContentType } from '$lib/types/Footer';
	export let title: string;
	export let content: FooterSectionContentType[];
</script>

<div class="md:w-1/2 w-full">
	<h4 class="text-2xl md:text-left text-center text-kn-a-light-blue">{title}</h4>
	<slot />
	<div class="text-blue flex flex-col md:flex-row items-center my-2 flex-wrap">
		{#each content as item}
			<a class="p-2" href={item.href}>{item.title}</a>
		{/each}
	</div>
</div>
