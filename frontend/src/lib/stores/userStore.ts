import type { UserStore } from '$lib/types/stores/UserStore';
import { writable, type Writable } from 'svelte/store';

export const userStore: Writable<UserStore> = writable({
	id: 0,
	name: '',
	isGuest: true
});
