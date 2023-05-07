<script lang="ts">
	import KadodeLogoString from '$lib/assets/logo/kadodeLogoString.svg?url';
</script>

<header class="sticky inset-x-0 top-0 w-screen">
	<div class="flex flex-col justify-center items-center md:flex-row">
		<div class="hidden w-1/3 md:block">
			<p>おためし</p>
		</div>
		<div class="flex justify-center w-full md:w-1/3 pt-8 md:pt-0">
			<a href="/" class="">
				<img src={KadodeLogoString} alt="Kadode Logo" class="p-2 object-fit" />
			</a>
		</div>
		<div class="flex justify-center md:justify-end items-center space-x-2 md:w-1/3 w-full">
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
