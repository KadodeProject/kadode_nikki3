<script lang="ts">
	import FooterButton from '$lib/components/atom/footer/FooterButton.svelte';
	import InterfaceContentBook2 from '$lib/assets/icon/interface-content-book-2.svg?src';
	import InterfaceHome3 from '$lib/assets/icon/interface-home-3.svg?src';
	import InterfaceContentChart from '$lib/assets/icon/interface-content-chart.svg?src';
	import EntertainmentPartyPopper from '$lib/assets/icon/entertainment-party-popper.svg?src';
</script>

<div class="md:hidden" style="height: 60px">
	<!-- mdフッターメニューのための余白 -->
</div>
<div
	id="mdFooter"
	class="bg-black w-full border-brown border-t-2 fixed bottom-0 right-0 md:hidden flex justify-around items-center z-10"
>
	<FooterButton url="/home" icon={InterfaceHome3} title="ホーム" />
	<FooterButton url="/diaries" icon={InterfaceContentBook2} title="アーカイブ" />
	<FooterButton url="/statistic" icon={InterfaceContentChart} title="統計" />
	<FooterButton url="/highlight" icon={EntertainmentPartyPopper} title="ハイライト" />
</div>

<style>
	#mdFooter {
		height: var(--footer-menu-height);
	}
</style>
