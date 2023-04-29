<script lang="ts">
	import Footer from '$lib/components/molecule/footer/Footer.svelte';
	import GuestHeader from '$lib/components/molecule/header/GuestHeader.svelte';
</script>

<GuestHeader />
<main>
	<slot />
</main>
<Footer />
