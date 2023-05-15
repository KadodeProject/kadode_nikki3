<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import AuthWrapper from '$lib/components/atom/wrapper/AuthWrapper.svelte';
	import SocialAuthElement from '$lib/components/organism/auth/SocialAuthElement.svelte';
</script>

<GuestHead title="ログイン" description="ログインページ" />

<AuthWrapper>
	<h2 class="text-2xl text-center">ソーシャルログイン</h2>
	<SocialAuthElement buttonName="ログイン" />
	<hr class="mt-12" />

	<h2 class="mt-4 text-2xl text-center">emailログイン</h2>

	<form method="post" action="?/login">
		<label class="block text-sm">
			<span class="text-white">メール</span>
			<input
				name="email"
				type="email"
				class="block mt-1 w-full text-sm text-black border-white focus:outline-none form-input focus:shadow-outline-purple"
				placeholder="mail"
			/>
		</label>
		<label class="block mt-4 text-sm">
			<span class="text-white">パスワード</span>
			<input
				name="password"
				class="block mt-1 w-full text-sm text-black border-white focus:outline-none form-input focus:shadow-outline-purple"
				placeholder="***************"
				type="password"
			/>
		</label>
		<div class="center">
			<button
				type="submit"
				class="py-2 px-4 mt-4 text-black rounded-2xl border-2 duration-300 border-kn-a-yellow bg-kn-a-yellow hover:bg-kn-a-green hover:border-kn-a-yellow hover:text-kn-a-yellow"
			>
				ログイン
			</button>
		</div>
	</form></AuthWrapper
>
