import type { Handle } from '@sveltejs/kit';

export const handle: Handle = async ({ event, resolve }) => {
	//全体で必要な処理があったらここに書いていく
	// stateの共有系は避ける→https://kit.svelte.jp/docs/state-management
	return await resolve(event);
};
