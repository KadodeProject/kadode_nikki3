<script lang="ts">
	import GuestHead from '$lib/components/atom/head/GuestHead.svelte';
	import PageHeading from '$lib/components/atom/heading/PageHeading.svelte';
	import FormalDocument from '$lib/components/atom/sentence/FormalDocument.svelte';
</script>

<GuestHead title="このサイトについて" description="このサイトについての説明ページ" />
<PageHeading title="このサイトについて" />

<div class="document-center">
	<FormalDocument title="対応ブラウザについて">
		<p>
			ChromeまたはMicrosoft
			Edge推奨です。他FirefoxおよびSafariに対応していますが、一部スタイルが適応されない可能性があります。
		</p>
	</FormalDocument>
	<!-- <FormalDocument title="複数タブでのご利用" content="複数のタブで同時に開いて日記の作成などを行うとCSRF(クロスサイトリクエストフォージェリ)対策関係のシステムの都合で409エラーが生じて日記の書き込みに失敗する場合があります。複数タブでのご利用はお控えください。"/> -->
	<FormalDocument title="JavaScript">
		<p>
			本サイトでは、グラフの表示、検索窓などのデザインのためにJavaScriptを使用しています。ご使用のブラウザ設定においてJavaScriptをオン
			(有効)にされていない場合に、グラフや検索窓が正しく表示されない場合やレイアウトが崩れる場合がありますので、ご了承ください。
		</p>
	</FormalDocument>
	<FormalDocument title="Cookie">
		<p>
			本サイトでは、ご利用者様が訪問された際、より快適にご利用いただくため、Cookieを使用しております。Cookieは、本サイトの運用に関連するサーバから、ご利用者さまのブラウザに送信する情報で、ご利用者さまのコンピューターに記録されますが、ご利用者さまのコンピューターへ直接的な悪影響を及ぼすことはございません。ご本人の希望で「Cookie」の受け取りを、ブラウザで設定することにより拒否することができますが、ログインや日記の作成が利用できない場合がありますので、予めご了承ください。
		</p>
	</FormalDocument>
	<FormalDocument title="Google Analytics">
		<p>
			本サービスではGoogleによるアクセス解析ツール「GoogleAnalytics」を利用しています。このGoogleAnalyticsはトラフィックデータの収集のためにクッキー（Cookie）を使用しております。トラフィックデータは匿名で収集されており、個人を特定するものではありません。この機能はCookieを無効にすることで収集を拒否することが出来ますので、お使いのブラウザの設定をご確認ください。
		</p>
	</FormalDocument>
	<p class="mb-20 text-center">
		<a href="https://policies.google.com/technologies/partner-sites?hl=ja"
			>Googleのサービスを使用するサイトやアプリから収集した情報のGoogleによる使用</a
		>
	</p>
</div>
