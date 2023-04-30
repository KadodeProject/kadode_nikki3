<script lang="ts">
	export let name: string;
	export let license: string;
	export let url: string;
	export let description: string;
</script>

<div>
	<a href={url} target="_blank" rel="noopener noreferrer">
		<h4 class="text-2xl text-center">{name}</h4>
		<p class="center">{description}</p>
		<p class="center mx-auto px-4 py-2 border border-blue">
			{license}
		</p>
	</a>
</div>
