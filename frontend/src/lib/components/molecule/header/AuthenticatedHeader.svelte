<script lang="ts">
	import { userStore } from '$lib/stores/userStore';
	import DarkModeButton from '$lib/components/organism/button/DarkModeButton.svelte';
</script>

<header class="border-b border-brown">
	<p>{$userStore.name}さん</p>
	<a
		href="/logout"
		class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
	>
		LogOut
	</a>
	<DarkModeButton />
</header>
