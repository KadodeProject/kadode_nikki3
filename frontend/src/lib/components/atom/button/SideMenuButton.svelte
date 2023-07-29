<script lang="ts">
	export let title: string;
	export let url: string;
	export let className = '';
	export let icon: string;
</script>

<a href={url}>
	<div
		class={`shadow-lg space-x-2 w-48 border-2 border-kn-l-brown bg-purple hover:bg-blue hover:border-blue rounded-xl px-4 py-3 duration-500 flex items-center justify-center ${className}`}
	>
		<div class="text-kn-white w-1/6">
			{@html icon}
		</div>
		<p class="text-xl w-5/6 text-kn-white">{title}</p>
	</div>
</a>
