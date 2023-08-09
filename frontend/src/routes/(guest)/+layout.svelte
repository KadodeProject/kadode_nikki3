<script lang="ts">
	import Footer from '$lib/components/molecule/footer/Footer.svelte';
	import GuestHeader from '$lib/components/molecule/header/GuestHeader.svelte';
</script>

<div class="main-wrapper">
	<GuestHeader />
	<div class="main-with-header">
		<main>
			<slot />
		</main>
		<Footer />
	</div>
</div>
