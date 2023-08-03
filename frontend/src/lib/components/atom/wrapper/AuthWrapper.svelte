<script lang="ts">
	import AuthBackground from '$lib/assets/background/authBackground.png';
</script>

<div class="flex w-full h-full">
	<div class="flex justify-center items-center w-full h-full md:w-1/2">
		<div class="p-4 mx-4 w-full rounded-2xl md:w-2/3 bg-kn-a-green">
			<slot />
		</div>
	</div>
	<div class="hidden h-full md:block md:w-1/2">
		<img src={AuthBackground} alt="認証背景" class="object-cover" />
	</div>
</div>
