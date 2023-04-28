import { writable } from 'svelte/store';

export const isDark = writable(false);

export const toggleDarkMode = () => {
	window.document.documentElement.classList.toggle('dark');
	isDark.update((v) => {
		localStorage.theme = v ? '' : 'dark';
		return !v;
	});
};
