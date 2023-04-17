import { env } from '$env/dynamic/public';
import { redirect, type RequestEvent } from '@sveltejs/kit';

interface ApiParams {
	method: string;
	event?: RequestEvent;
	resource?: string;
	data?: Record<string, unknown> | null;
}

export async function backendApiAdapter(params: ApiParams): Promise<Record<string, unknown>> {
	const base = env.PUBLIC_BASE_API;
	let fullUrl = base;

	if (params.resource) {
		fullUrl = `${base}/${params.resource}`;
	}

	//   クッキーの中にあるXSRF-TOKENを取得
	const response = await fetch(fullUrl, {
		method: params.method,
		headers: {
			mode: 'cors',
			//   'credentials': 'include',
			origin: 'http://localhost:2000',
			'content-type': 'application/json',
			accept: 'application/json',
			'X-XSRF-TOKEN': params?.event?.cookies?.get('XSRF-TOKEN') as string,
			cookie: params?.event?.request?.headers?.get('cookie') as string
		},
		body: params.data && JSON.stringify(params.data)
	});
	if (response.status === 401 || response.status === 419) {
		// 認証できていないか、認証切れか、CSRFトークンが古いのでリダイレクト(クッキーはログインで上書きするので消す必要なし)
		// console.log(response);
		throw redirect(302, env.PUBLIC_LOGIN_PATH);
	} else if (response.status === 500) {
		console.log(response);
	}

	return response.json();
}
