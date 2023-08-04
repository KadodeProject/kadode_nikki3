<script lang="ts">
	import SideMenuButton from '$lib/components/atom/button/SideMenuButton.svelte';
	import InterfaceContentBook2 from '$lib/assets/icon/interface-content-book-2.svg?src';
	import InterfaceHome3 from '$lib/assets/icon/interface-home-3.svg?src';
	import InterfaceContentChart from '$lib/assets/icon/interface-content-chart.svg?src';
	import EntertainmentPartyPopper from '$lib/assets/icon/entertainment-party-popper.svg?src';
	import InterfaceSettingCog from '$lib/assets/icon/interface-setting-cog.svg?src';
	import KadodeLogo from '$lib/assets/logo/kadodeLogo.svg?component';
</script>

<nav class="bg-purple">
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
</nav>

<style>
	nav {
		width: var(--sidemenu-width);
		height: 100%;
		overflow-x: clip;
		overflow-y: auto;
	}
</style>
