<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import CreditHeading from '$lib/components/atom/heading/CreditHeading.svelte';
	import CreditSentence from '$lib/components/atom/sentence/CreditSentence.svelte';
</script>

<GuestHead title="クレジット" slug="/credit" description="使用したライセンスの掲載ページ" />

<h1 class="text-center mb-12 text-blue">クレジット</h1>

<CreditHeading title="デザイン" />
<CreditSentence
	name="Streamline"
	url="https://www.streamlinehq.com/"
	description="アイコンで使用させていただいています。"
	license="CC BY 4.0"
/>
