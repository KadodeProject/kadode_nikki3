import type { RequestEvent } from '@sveltejs/kit';
import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import { authenticatedApiMiddleware } from '$src/lib/middleware/authenticatedApiMiddleware';
//layoutにすることで配下のページでも再度リクエスト叩かず使えるようにする
export const load = async (event: RequestEvent) => {
	const response = await authenticatedApiMiddleware(
		aApiClient({ event: event }).api.v1.statistic.$get
	);
	return response.data;
};
