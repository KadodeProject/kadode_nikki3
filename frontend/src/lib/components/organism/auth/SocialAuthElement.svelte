<script lang="ts">
	import GitHubLogo from '$lib/assets/logo/gitHubLogo.svg?url';
	// import GoogleLogo from '$lib/assets/logo/googleLogo.svg?url';
	// import { callbackGoogle, callbackGitHub } from '$lib/utils/oAuthCallback';
	import SocialAuthButton from '$lib/components/atom/button/SocialAuthButton.svelte';
	import { callbackGitHub } from '$lib/utils/oAuthCallback';
	export let buttonName: string;
</script>

<!-- ログイン状態が保持できないので、一旦Googleは対象外にして初版は公開する -->
<!-- <SocialAuthButton -->
<!-- 	providerName="Google" -->
<!-- 	type={buttonName} -->
<!-- 	handleClick={callbackGoogle} -->
<!-- 	icon={GoogleLogo} -->
<!-- /> -->
<SocialAuthButton
	providerName="GitHub"
	type={buttonName}
	handleClick={callbackGitHub}
	icon={GitHubLogo}
/>
