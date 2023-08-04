<script lang="ts">
	export let title: string;
</script>

<div class="w-full md:w-1/3">
	<h2 class="text-center">{title}</h2>
	<slot />
</div>
