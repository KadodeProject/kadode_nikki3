<!-- PC版のサイドメニュー -->
<script lang="ts">
	import SideMenuButton from '$lib/components/atom/button/SideMenuButton.svelte';
	import InterfaceContentBook2 from '$lib/assets/icon/interface-content-book-2.svg?src';
	import InterfaceHome3 from '$lib/assets/icon/interface-home-3.svg?src';
	import InterfaceContentChart from '$lib/assets/icon/interface-content-chart.svg?src';
	import EntertainmentPartyPopper from '$lib/assets/icon/entertainment-party-popper.svg?src';
	import InterfaceSettingCog from '$lib/assets/icon/interface-setting-cog.svg?src';
	import KadodeLogo from '$lib/assets/logo/kadodeLogo.svg?component';
	import { fly } from 'svelte/transition';
	import { isSideMenuOpen, closeSideMenu, openSideMenu } from '$lib/stores/sidemenu';
</script>

{#if $isSideMenuOpen}
	<!-- ここイージングでslideとかしてきれいにしたい -->
	<nav class="bg-purple hidden md:block" transition:fly={{ x: -200, duration: 1000 }}>
		<a href="/" class="flex justify-center items-center p-2 mb-4">
			<KadodeLogo width="60" height="60" />
			<h2 class="pl-2 text-2xl">かどで日記</h2>
		</a>

		<div class="flex flex-col justify-center items-center space-y-4">
			<SideMenuButton title="ホーム" url="/home" icon={InterfaceHome3} />
			<SideMenuButton title="アーカイブ" url="/archive" icon={InterfaceContentBook2} />
			<SideMenuButton title="統計" url="/statistics" icon={InterfaceContentChart} />
			<SideMenuButton title="ハイライト" url="/highlight" icon={EntertainmentPartyPopper} />
			<SideMenuButton title="設定" url="/settings" icon={InterfaceSettingCog} />
		</div>
		<button on:click={closeSideMenu} class="rounded-full w-8 h-8 bg-brown mx-auto ml-2 mt-4">
			←
		</button>
	</nav>
{:else}
	<button on:click={openSideMenu} style="writing-mode: vertical-rl;" class="bg-purple">
		メニュー
	</button>
{/if}

<style>
	nav {
		width: var(--sidemenu-width);
		height: 100%;
		overflow-x: clip;
		overflow-y: auto;
	}
</style>
