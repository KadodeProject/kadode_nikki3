<script lang="ts">
	import Footer from '$lib/components/molecule/footer/Footer.svelte';
	import SideMenu from '$lib/components/molecule/sidemenu/SideMenu.svelte';
	import AuthenticatedHeader from '$lib/components/molecule/header/AuthenticatedHeader.svelte';
</script>

<div class="flex h-screen">
	<SideMenu />
	<div class="main-wrapper">
		<AuthenticatedHeader />
		<div class="main-with-header">
			<main>
				<slot />
			</main>
			<Footer />
		</div>
	</div>
</div>
