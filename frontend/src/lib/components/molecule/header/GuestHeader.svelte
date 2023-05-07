<script lang="ts">
	import KadodeLogoString from '$lib/assets/logo/kadodeLogoString.svg?component';
</script>

<header class="sticky inset-x-0 top-0 w-screen">
	<div class="flex justify-center items-center">
		<div class="w-1/3" />
		<div class="flex justify-center w-1/3">
			<a href="/" class="">
				<KadodeLogoString width="330" height="60" />
			</a>
		</div>
		<div class="flex justify-end items-center space-x-2 w-1/3">
			<a
				href="/regsiter"
				class="py-2 px-4 text-black rounded-2xl border-2 border-black duration-300 hover:bg-black bg-kn-a-yellow hover:border-kn-a-yellow hover:text-kn-a-yellow"
			>
				新規登録
			</a>
			<a
				href="/login"
				class="py-2 px-4 text-black rounded-2xl border-2 border-black duration-300 hover:bg-black bg-kn-a-yellow hover:border-kn-a-yellow hover:text-kn-a-yellow"
			>
				ログイン
			</a>
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
		width: var(--main-max-width);
		height: var(--heder-height);
	}
</style>
