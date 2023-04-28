<script lang="ts">
	export let title = 'ボタン名';
	export let url = '/link';
	export let className = '';
</script>

<div class={` flex items-center justify-center ${className}`}>
	<a href={url}>
		<div class="bg-purple hover:bg-blue flex rounded-xl px-4 py-3 duration-500">
			<p class="text-white">{title}</p>
		</div>
	</a>
</div>
