import { apiUrlResolver } from '$src/lib/utils/apiUrlResolver';
import api from '$apiSchema/$api';
import aspida from '@aspida/node-fetch';
import fetch from 'node-fetch';
import type { RequestEvent } from '@sveltejs/kit';

import { env } from '$env/dynamic/public';
interface ApiParams {
	event?: RequestEvent;
	data?: Record<string, unknown> | null;
}
export const aApiClient = (params: ApiParams) => {
	const aspidaFetchConfig = {
		baseURL: apiUrlResolver(),
		throwHttpErrors: true,
		headers: {
			// mode: 'cors',
			//   'credentials': 'include',
			origin: env.PUBLIC_APP_URL,
			'content-type': 'application/json',
			accept: 'application/json',
			//   クッキーの中にあるXSRF-TOKENを取得
			'X-XSRF-TOKEN': params?.event?.cookies?.get('XSRF-TOKEN') as string,
			cookie: params?.event?.request?.headers?.get('cookie') as string
		}
	};
	return api(aspida(fetch, aspidaFetchConfig));
};
