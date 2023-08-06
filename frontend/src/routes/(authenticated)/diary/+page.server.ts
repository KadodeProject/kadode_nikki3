import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import type { RequestEvent } from '@sveltejs/kit';
import type { Actions } from './$types';
export const actions = {
	default: async (event: RequestEvent) => {
		const form = await event.request.formData();
		const response = await aApiClient({
			event: event
		}).api.v1.diary.$post({
			body: {
				date: form.get('date')?.toString(),
				title: form.get('title')?.toString(),
				content: form.get('content')?.toString()
			}
		});
		return response;
	}
} satisfies Actions;
