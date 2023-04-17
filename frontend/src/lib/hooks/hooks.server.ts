import { userStore } from '$lib/stores/userStore';
import type { UserStore } from '$lib/types/stores/UserStore';
import { backendApiAdapter } from '$lib/utils/adapter/backendApiAdapter';
import type { Handle } from '@sveltejs/kit';

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
			const userInfo = await backendApiAdapter({
				method: 'get',
				resource: 'api/user/init',
				event
			});
			userStore.set(userInfo as UserStore);
		}
	}
	return await resolve(event);
};
