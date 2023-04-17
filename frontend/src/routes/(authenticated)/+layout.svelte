<script lang="ts">
	import Footer from '$lib/components/molecule/footer/Footer.svelte';
	import GuestHeader from '$lib/components/molecule/header/GuestHeader.svelte';
	import { userStore } from '$lib/stores/userStore';
</script>

<GuestHeader />
<p>{$userStore.name}さん</p>
<a
	href="/logout"
	class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
>
	LogOut
</a>
<main>
	<slot />
</main>
<Footer />
