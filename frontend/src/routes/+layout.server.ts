//認証チェックする
import type { RequestEvent } from '@sveltejs/kit';
import { aApiClient } from '$lib/utils/client/backendAuthenticatedApiClient';
export const load = async (event: RequestEvent) => {
	let user;
	//初回アクセス。ログイン、ログアウトの時にロード走るがそれ以外のタイミングではページ遷移しても走らないのでAPIアクセスに無駄がない
	if (event?.cookies?.get('XSRF-TOKEN') !== undefined) {
		user = await aApiClient({
			event: event
		}).api.v1.user.init.$get();
		//認証できなかったら上で例外飛ぶのでここの時点で確実に認証OK
		user['isGuest'] = false;
	} else {
		user = {
			id: 0,
			name: 'guest',
			isGuest: true
		};
	}
	return { user: user };
};
