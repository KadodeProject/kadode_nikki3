<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import CreditHeading from '$lib/components/atom/heading/CreditHeading.svelte';
	import CreditSentence from '$lib/components/atom/sentence/CreditSentence.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
</script>

<GuestHead title="クレジット" description="使用したライセンスの掲載ページ" />
<PageHeading title="クレジット" />

<CreditHeading title="デザイン" />
<CreditSentence
	name="Streamline"
	url="https://www.streamlinehq.com/"
	description="アイコンで使用させていただいています。"
	license="CC BY 4.0"
/>
