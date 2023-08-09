<script lang="ts">
	export let disabled = false;
	export let className = '';
</script>

<button type="submit" id="submitDiary" class={className} {disabled}> 日記を保存 </button>

<style>
	button:disabled {
		background-color: var(--kn-s-3);
	}
</style>
