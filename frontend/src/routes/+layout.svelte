<script lang="ts">
	import NotLoggedInFooter from '$lib/components/molecule/footer/NotLoggedInFooter.svelte';
	import NotLoggedInHeader from '$lib/components/molecule/header/NotLoggedInHeader.svelte';
	import '../app.css';
</script>

<NotLoggedInHeader />
<main>
	<slot />
</main>
<NotLoggedInFooter />
