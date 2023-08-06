import type { RequestEvent } from '@sveltejs/kit';
import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import { authenticatedApiMiddleware } from '$src/lib/middleware/authenticatedApiMiddleware';
import { error } from '@sveltejs/kit';
export const load = async (event: RequestEvent) => {
	const paramDate = event?.params?.date as string; //ここでは絶対日付の文字列あるので、型アサーション

	//日付が2022-01-01形式で内科をチェック(API側でもチェックしてるが無駄なリクエスト叩かないよいうに先に弾く)
	if (!paramDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
		throw error(404, {
			message: 'Not found'
		});
	}

	const response = await authenticatedApiMiddleware(
		aApiClient({ event: event }).api.v1.diary._date(paramDate).$get
	);
	return response.data;
};
