<script lang="ts">
	import KadodeLogoString from '$lib/assets/logo/kadodeLogoString.svg?url';
	import FooterSection from '$lib/components/atom/footer/FooterSection.svelte';
	const sitemapContent = [
		{ href: '/', title: 'かどで日記トップ' },
		// { href: '/', title: 'しくみ' },
		{ href: '/credit', title: 'クレジット' },
		{ href: '/contact', title: 'お問い合わせ' },
		{ href: '/releaseNote', title: 'リリースノート' },
		{ href: '/notice', title: 'お知らせ' }
	];
	const administrationContent = [
		{ href: 'https://portal.kado.day', title: 'かどでポータル' },
		{ href: 'https://wiki.kado.day', title: 'かどで日記wiki' },
		{ href: 'https://github.com/KadodeProject', title: 'GitHub' },
		{ href: 'https://note.com/kadoday', title: 'note' }
		// { href: '', title: 'misskey' }
	];
</script>

<footer class="border-t-2 border-brown">
	<p class="text-xs text-kn-a-green mt-4 text-center">copyright Kadode Project 2020~2023</p>
	<div class="flex flex-col md:flex-row mx-auto md:w-4/5">
		<div class="md:w-1/5 w-2/3 mx-auto">
			<img src={KadodeLogoString} alt="Kadode Logo" class="p-2 object-fit" />
		</div>
		<div
			class="md:w-4/5 flex flex-col justify-center items-stretch my-4 mx-2 md:flex-row flex-wrap"
		>
			<FooterSection title="sitemap" content={sitemapContent} />
			<FooterSection title="administration" content={administrationContent}>
				<div class="pl-2 text-kn-a-light-blue">
					<p class="text-lg mt-2">Kadode Project</p>
					<p>本サービスは「うすゆき」が個人で運営しています</p>
				</div>
			</FooterSection>
			<div
				class="text-brown border-t-2 border-dashed border-kn-a-green w-full flex flex-wrap flex-col md:flex-row justify-center items-center"
			>
				<a class="p-2" href="/privacyPolicy">プライバシーポリシー</a>
				<a class="p-2" href="/terms">利用規約</a>
				<a class="p-2" href="/aboutThisSite">このサイトについて</a>
			</div>
		</div>
	</div>
</footer>
