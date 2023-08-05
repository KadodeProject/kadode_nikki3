import type { RequestEvent } from '@sveltejs/kit';
import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';

export const load = async (event: RequestEvent) => {
	const response = aApiClient({ event: event }).api.v1.home.$get();
	return response;
};
