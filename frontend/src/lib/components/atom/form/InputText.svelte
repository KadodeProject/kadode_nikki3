<script lang="ts">
	export let name: string;
	export let id: string;
	export let type: 'text' | 'email' | 'password' | 'date';
	export let placeholder = '';
	export let autocomplete: 'on' | 'off' = 'on';
	export let value = '';
	export let className = '';
	export let disabled = false;
	export let errorMessages: string[] = [];
	$: hasError = errorMessages.length > 0;
</script>

<input
	{type}
	{placeholder}
	{name}
	{id}
	{value}
	class={className}
	class:error={hasError}
	{disabled}
	{autocomplete}
/>
{#if hasError}
	{#each errorMessages as message}
		<p class="text-kn-s-3">{message}</p>
	{/each}
{/if}

<style>
	input.error {
		background-color: var(--kn-s-3);
	}
</style>
