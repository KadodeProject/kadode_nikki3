import { writable } from 'svelte/store';
export const isSideMenuOpen = writable(true);
// 強制サイドメニュー発動時の状態保存用
export const isSideMenuOpenTmp = writable(true);
export const closeSideMenu = () => {
	isSideMenuOpen.update(() => {
		return false;
	});
};
export const openSideMenu = () => {
	isSideMenuOpen.update(() => {
		return true;
	});
};
