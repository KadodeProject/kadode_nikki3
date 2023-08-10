import { HTTPError } from '@aspida/fetch';
import { redirect } from '@sveltejs/kit';
import { error } from '@sveltejs/kit';
// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const authenticatedApiMiddleware = async (apiClient: () => Promise<any>) => {
	try {
		return await apiClient();
	} catch (e) {
		if (e instanceof HTTPError) {
			//statusに応じてswitch
			switch (e.response.status) {
				case 401:
					throw redirect(307, '/login');
				case 404:
					throw error(404, {
						message: 'Not found'
					});
				case 422:
					console.log(e.response.body);
					throw e;
				default:
					throw e;
			}
		}
		throw e;
	}
};
