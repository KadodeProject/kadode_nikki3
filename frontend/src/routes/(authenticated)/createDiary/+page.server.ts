import { backendApiAdapter } from '$lib/utils/adapter/backendApiAdapter';
import type { RequestEvent } from '@sveltejs/kit';
import type { Actions } from './$types';
export const actions = {
	default: async (event: RequestEvent) => {
		const form = await event.request.formData();
		const response = await backendApiAdapter({
			method: 'post',
			resource: 'api/diary/create',
			event: event,
			data: {
				date: form.has('date') ? form.get('date') : undefined,
				title: form.has('title') ? form.get('title') : undefined,
				content: form.has('content') ? form.get('content') : undefined
			}
		});
		return response.data;
	}
} satisfies Actions;
