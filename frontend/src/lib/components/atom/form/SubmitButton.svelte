<script lang="ts">
	export let disabled = false;
	export let className = '';
	export let id = '';
	export let content: string;
</script>

<button type="submit" {id} {disabled} class={className}>
	{content}
</button>

<style>
	button:disabled {
		background-color: var(--kn-s-3);
	}
</style>
