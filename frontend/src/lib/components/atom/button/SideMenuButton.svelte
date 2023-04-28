<script lang="ts">
	export let title: string;
	export let url: string;
	export let className = '';
	export let icon: string;
</script>

<a href={url}>
	<div
		class={`space-x-2 w-40 border border-white bg-purple hover:bg-blue rounded-xl px-4 py-3 duration-500 flex items-center justify-center ${className}`}
	>
		{@html icon}
		<p class="text-white">{title}</p>
	</div>
</a>
