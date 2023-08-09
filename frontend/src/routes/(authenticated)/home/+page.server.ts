import type { RequestEvent } from '@sveltejs/kit';
import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import { authenticatedApiMiddleware } from '$src/lib/middleware/authenticatedApiMiddleware';

export const load = async (event: RequestEvent) => {
	const response = await authenticatedApiMiddleware(
		aApiClient({ event: event }).api.v1.home.$get
	);
	return response;
};
