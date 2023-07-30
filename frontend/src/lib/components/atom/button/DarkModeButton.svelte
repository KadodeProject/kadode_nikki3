<!-- hoge -->
<script lang="ts">
	import { isDark, toggleDarkMode } from '$lib/stores/utility';
	import InterfaceWeatherMoon from '$lib/assets/icon/interface-weather-moon.svg?component';
	import InterfaceLightingBrightness4 from '$lib/assets/icon/interface-lighting-brightness-4.svg?component';
</script>

<button
	class="p-2 flex justify-center items-center text-brown hover:text-blue"
	on:click={toggleDarkMode}
	aria-label="Toggle color mode"
>
	{#if $isDark}
		<InterfaceWeatherMoon width="20" />
	{:else}
		<InterfaceLightingBrightness4 width="20" />
	{/if}
</button>
