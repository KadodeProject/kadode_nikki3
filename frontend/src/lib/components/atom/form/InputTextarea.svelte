<script lang="ts">
	export let name: string;
	export let id: string;
	export let placeholder = '';
	export let autocomplete: 'on' | 'off' = 'off';
	export let value = '';
	export let className = '';
	export let disabled = false;
	export let errorMessages: string[] = [];
	$: hasError = errorMessages.length > 0;
</script>

<textarea
	{placeholder}
	class={className}
	{name}
	{id}
	class:error={hasError}
	{disabled}
	{autocomplete}>{value}</textarea
>
{#if hasError}
	{#each errorMessages as message}
		<p class="text-kn-s-3">{message}</p>
	{/each}
{/if}

<style>
	textarea.error {
		background-color: var(--kn-s-3);
	}
</style>
