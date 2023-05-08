<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import CreditSentence from '$lib/components/atom/sentence/CreditSentence.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
</script>

<GuestHead title="クレジット" description="使用したライセンスの掲載ページ" />
<PageHeading title="クレジット" />

<div class="document-center">
	<CreditSentence
		name="Streamline"
		url="https://www.streamlinehq.com/"
		description="アイコンで使用させていただいています。"
		license="CC BY 4.0"
	/>
</div>
