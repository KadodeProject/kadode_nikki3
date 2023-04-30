<script lang="ts">
	import { page } from '$app/stores';
	const SITE_URL = 'https://kado.day';
	const SITE_TITLE = 'かどで日記';
	const SITE_SUB_TITLE = 'かどで日記は振り返りも楽しめる日記Webアプリです';
	const SITE_AUTHOR = 'うすゆき';
	const TWITTER_ID = '@usuyuki26';

	export let title: string;
	export let description: string;
	export let ogImage: string = SITE_URL + '/img/ogp/ogp.png';

	let pageTitle = title + ' | ' + SITE_TITLE;
</script>

<svelte:head>
	<title>{pageTitle}</title>
	<meta name="author" content={SITE_AUTHOR} />
	<meta name="description" content={description} />
	<meta name="thumbnail" content={ogImage} />

	<meta name="robots" content="max-image-preview:large" />
	<meta property="og:locale" content="ja_JP" />
	<meta property="og:site_name" content={SITE_TITLE + ' - ' + SITE_SUB_TITLE} />
	<meta property="og:type" content="article" />
	<meta property="og:title" content={pageTitle} />
	<meta property="og:url" content={$page.url.href} />
	<meta property="og:image" content={ogImage} />
	<meta property="og:image:secure_url" content={ogImage} />

	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content={TWITTER_ID} />
	<meta name="twitter:creator" content={TWITTER_ID} />
	<meta name="twitter:title" content={pageTitle} />
	<meta name="twitter:image" content={ogImage} />
</svelte:head>
