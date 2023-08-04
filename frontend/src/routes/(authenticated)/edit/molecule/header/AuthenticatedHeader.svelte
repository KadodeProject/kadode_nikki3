<script lang="ts">
	import { userStore } from '$lib/stores/userStore';
	import DarkModeButton from '$lib/components/atom/button/DarkModeButton.svelte';
</script>

<header class="border-b border-brown">
	<p>{$userStore.name}さん</p>
	<a
		href="/logout"
		class="block py-2 px-4 mt-4 w-full text-sm font-medium leading-5 text-center text-white bg-purple-600 rounded-lg border border-transparent transition-colors duration-150 hover:bg-purple-700 focus:outline-none active:bg-purple-600 focus:shadow-outline-purple"
	>
		LogOut
	</a>
	<DarkModeButton />
</header>

<style>
	header {
		height: var(--heder-height);
		backdrop-filter: blur(4px);
		border-bottom: 1px solid var(--kn-s-1);
	}
</style>
