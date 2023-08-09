import { env } from '$env/dynamic/public';
import type { Actions } from '@sveltejs/kit';
import { redirect, type RequestEvent } from '@sveltejs/kit';

export const actions: Actions = {
	logout: async (event: RequestEvent) => {
		console.log('delete cookie');
		event.cookies.delete('XSRF-TOKEN');
		event.cookies.delete('kadode_nikki3_session');
		throw redirect(302, env.PUBLIC_LOGIN_PATH);
	}
};
