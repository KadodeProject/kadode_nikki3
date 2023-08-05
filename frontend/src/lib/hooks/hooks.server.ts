import { userStore } from '$lib/stores/userStore';
import { aApiClient } from '../utils/client/backendAuthenticatedApiClient';
import type { Handle } from '@sveltejs/kit';
import type { UserStore } from '$lib/types/stores/UserStore';

export const handle: Handle = async ({ event, resolve }) => {
	// 認証必要か判定→各ページのAPIレスポンスで認証できてなかったらリダイレクト掛かるのでこのままで良い
	if (event.route.id !== null && event.route.id.indexOf('(authenticated)') !== -1) {
		//変数だけ宣言したいが型解析でis used before being assignedになるので初期値を入れている
		let userStoreValue: UserStore = { id: 0, name: '' };
		userStore.subscribe((value: UserStore) => {
			userStoreValue = value;
		});
		// 認証必要なページなので、認証効いてなかったらadapter側でリダイレクト掛かるのでここでは不要
		if (userStoreValue.id === 0) {
			console.log('値をセット');
			const userInfo = await aApiClient({
				event: event
			}).api.v1.user.init.$get();
			console.log(userInfo);
			userStore.set(userInfo);
		}
	}
	return await resolve(event);
};
