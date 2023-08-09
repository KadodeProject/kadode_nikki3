import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import type { RequestEvent } from '@sveltejs/kit';
import type { Actions } from './$types';
export const actions = {
	default: async (event: RequestEvent) => {
		const form = await event.request.formData();
		const dateF = form.get('date');
		const titleF = form.get('title');
		const contentF = form.get('content');
		if (dateF === null || titleF === null || contentF === null) {
			throw new Error('invalid request');
		}
		const response = await aApiClient({
			event: event
		}).api.v1.diary.$post({
			body: {
				date: dateF.toString(),
				title: titleF.toString(),
				content: contentF.toString()
			}
		});
		return response;
	}
} satisfies Actions;
