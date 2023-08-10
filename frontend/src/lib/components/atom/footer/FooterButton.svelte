<script lang="ts">
	export let url: string;
	export let icon: string;
	export let title: string;
</script>

<div>
	<a class="flex justify-center items-center flex-col" href={url}>
		<div class="w-10 h-10 p-2 flex justify-center items-center">
			{@html icon}
		</div>
		<div class="text-xs">{title}</div>
	</a>
</div>
