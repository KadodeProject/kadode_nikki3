<!-- 利用規約やこのサイトについてなどフォーマルな場面で使う文章コンポーネント -->
<script lang="ts">
	export let title: string;
</script>

<div class="px-4 pb-12">
	<div class="flex items-center">
		<div class="w-2 h-8 bg-kn_3" />
		<h2 class="ml-2 text-2xl">{title}</h2>
	</div>
	<div class="py-4 ml-2">
		<slot />
	</div>
</div>
