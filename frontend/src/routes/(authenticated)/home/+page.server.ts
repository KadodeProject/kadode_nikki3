import { backendApiAdapter } from '$lib/utils/adapter/backendApiAdapter';
import type { RequestEvent } from '@sveltejs/kit';
type Response = {
	name: string;
};
export const load = async (event: RequestEvent) => {
	const response = await backendApiAdapter({
		method: 'get',
		resource: 'api/test',
		event: event
	});
	const data = response as Response;
	return data;
};
