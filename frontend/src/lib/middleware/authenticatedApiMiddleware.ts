import { HTTPError } from '@aspida/fetch';
import { redirect } from '@sveltejs/kit';
import { error } from '@sveltejs/kit';
// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const authenticatedApiMiddleware = async (apiClient: () => Promise<any>) => {
	try {
		return await apiClient();
	} catch (e) {
		if (e instanceof HTTPError) {
			if (e.response.status === 401) {
				console.log('redirecting');
				// 401エラーの場合は、ログイン画面にリダイレクト
				throw redirect(307, '/login');
			} else if (e.response.status === 404) {
				throw error(404, {
					message: 'Not found'
				});
			}
		}
		throw e;
	}
};
