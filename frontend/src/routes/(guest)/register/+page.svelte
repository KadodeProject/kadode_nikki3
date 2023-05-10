<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import AuthWrapper from '$lib/components/atom/wrapper/AuthWrapper.svelte';
	import GitHubLogo from '$lib/assets/logo/gitHubLogo.svg?url';
	import GoogleLogo from '$lib/assets/logo/googleLogo.svg?url';
	import SocialAuthButton from '$lib/components/atom/button/SocialAuthButton.svelte';
</script>

<GuestHead title="新規登録" description="かどで日記新規登録ページ" />

<AuthWrapper>
	<h2 class="text-2xl text-center">ソーシャル認証</h2>
	<SocialAuthButton providerName="Google" type="登録" url="/auth/google" icon={GoogleLogo} />
	<SocialAuthButton providerName="GitHub" type="登録" url="/auth/GitHub" icon={GitHubLogo} />
</AuthWrapper>
