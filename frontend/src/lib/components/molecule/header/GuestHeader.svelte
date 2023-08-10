<script lang="ts">
	import KadodeLogoString from '$lib/assets/logo/kadodeLogoString.svg?url';
	import YellowButton from '$lib/components/atom/button/YellowButton.svelte';
	import { userStore } from '$lib/stores/userStore';
</script>

<header class="sticky inset-x-0 top-0 w-screen">
	<div class="flex flex-col justify-center items-center md:flex-row">
		<div class="hidden w-1/3 md:block">
			<p>public beta</p>
		</div>
		<div class="flex justify-center pt-8 w-full md:pt-0 md:w-1/3">
			<a href="/" class="">
				<img src={KadodeLogoString} alt="Kadode Logo" class="p-2 object-fit" />
			</a>
		</div>
		<div class="flex justify-center items-center space-x-2 w-full md:justify-end md:w-1/3">
			{#if $userStore.isGuest}
				<YellowButton title="新規登録" url="/register" />
				<YellowButton title="ログイン" url="/login" />
			{:else}
				<YellowButton title="ホーム" url="/home" />
			{/if}
		</div>
	</div>
</header>

<style>
	header {
		height: var(--heder-height);
		backdrop-filter: blur(4px);
		border-bottom: 1px solid var(--kn-s-1);
	}
	header > div {
		margin: 0 auto;
		max-width: var(--main-max-width);
		height: var(--heder-height);
	}
	a > img {
		height: var(--heder-height);
	}
	@media screen and (max-width: 640px) {
		header {
			height: calc(var(--heder-height) * 2);
		}
		a > img {
			height: calc(var(--heder-height) * 1.2);
		}
	}
</style>
