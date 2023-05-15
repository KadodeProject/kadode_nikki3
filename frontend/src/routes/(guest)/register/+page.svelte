<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import AuthWrapper from '$lib/components/atom/wrapper/AuthWrapper.svelte';
	import SocialAuthElement from '$lib/components/organism/auth/SocialAuthElement.svelte';
</script>

<GuestHead title="新規登録" description="かどで日記新規登録ページ" />

<AuthWrapper>
	<h2 class="text-2xl text-center">ソーシャル認証</h2>
	<SocialAuthElement buttonName="登録" />
</AuthWrapper>
