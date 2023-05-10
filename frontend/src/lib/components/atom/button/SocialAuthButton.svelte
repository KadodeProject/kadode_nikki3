<script lang="ts">
	export let icon: string;
	export let providerName: string;
	export let type: string;
	export let url: string;
</script>

<div class="m-4 center">
	<a href={url} class="flex justify-center items-center py-2 px-4 h-12 rounded-2xl border">
		<img src={icon} alt={providerName} class="ml-1 w-6 h-6 object-fit" />
		<p class="pl-1">{providerName}で{type}</p>
	</a>
</div>

<style>
	a {
		/* googleのロゴ利用規約的に背景は#fffにする必要がある */
		background-color: #fff;
		color: #000;
	}
</style>
