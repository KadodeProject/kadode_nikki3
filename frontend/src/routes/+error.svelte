<script lang="ts">
	import { page } from '$app/stores';
</script>

<h1 class="text-3xl text-center mx-2 my-2">
	<p class="">{$page.error === null ? 'No Error' : $page.error.message}</p>
</h1>
<div class="flex mx-2 my-2 justify-center" />
