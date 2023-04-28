<script lang="ts">
	import '$src/app.css';
	import { browser } from '$app/environment';
	import { isDark } from '$lib/stores/utility';

	if (browser && localStorage.theme === 'dark') {
		isDark.update(() => true);
	} else {
		isDark.update(() => false);
	}
</script>

<!-- フッターなどは(authenticated),(auth)でそれぞれ使う。ここはグローバルで使うCSSを入れる -->
<div class="bg-black text-white">
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
