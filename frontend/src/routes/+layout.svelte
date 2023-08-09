<script lang="ts">
	import '$src/app.css';
	import { browser } from '$app/environment';
	import { userStore } from '$lib/stores/userStore';
	import { isDark } from '$lib/stores/utility';
	import type { LayoutData } from './$types';

	if (browser && localStorage.theme === 'dark') {
		isDark.update(() => true);
	} else {
		isDark.update(() => false);
	}

	//サイト訪問時に認証情報をセットする
	export let data: LayoutData;
	userStore.set(data.user);
</script>

<!-- フッターなどは(authenticated),(auth)でそれぞれ使う。ここはグローバルで使うCSSを入れる -->
<div class="overflow-scroll">
	<slot />
</div>

<svelte:head>
	<script>
		if (
			localStorage.theme === 'dark' ||
			(!('theme' in localStorage) &&
				window.matchMedia('(prefers-color-scheme: dark)').matches)
		) {
			document.documentElement.classList.add('dark');
			localStorage.theme = 'dark';
		} else {
			document.documentElement.classList.remove('dark');
		}
	</script>
</svelte:head>
