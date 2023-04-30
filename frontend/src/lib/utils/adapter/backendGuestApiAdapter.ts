// backendGuestの方はクライアントでも実行できるように想定
// いずれはauth含めてクライアント対応したいが、現状クッキー周りをうまく渡せていない
import { env } from '$env/dynamic/public';
import type { RequestEvent } from '@sveltejs/kit';

interface ApiParams {
	method: string;
	event?: RequestEvent;
	resource?: string;
	data?: Record<string, unknown> | null;
}

export async function backendGuestApiAdapter(params: ApiParams): Promise<Record<string, unknown>> {
	const base = env.PUBLIC_BASE_API;
	let fullUrl = base;

	if (params.resource) {
		fullUrl = `${base}/${params.resource}`;
	}

	//   クッキーの中にあるXSRF-TOKENを取得
	const response = await fetch(fullUrl, {
		method: params.method,
		body: params.data && JSON.stringify(params.data)
	});

	return response.json();
}
