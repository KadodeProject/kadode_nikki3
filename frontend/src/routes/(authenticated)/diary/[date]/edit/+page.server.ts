import { aApiClient } from '$src/lib/utils/client/backendAuthenticatedApiClient';
import { redirect } from '@sveltejs/kit';
import type { RequestEvent } from '@sveltejs/kit';
import type { Actions } from './$types';
export const actions = {
	update: async (event: RequestEvent) => {
		const form = await event.request.formData();
		const idF = form.get('id');
		const dateF = form.get('date');
		const titleF = form.get('title');
		const contentF = form.get('content');
		const urlDate = event?.params?.date;
		// felteでバリデーションしているので、stringに強制キャストして静的解析黙らせても良い気がする
		if (
			idF === null ||
			dateF === null ||
			titleF === null ||
			contentF === null ||
			urlDate === undefined
		) {
			throw new Error('invalid request');
		}
		await aApiClient({
			event: event
		})
			.api.v1.diary._date(urlDate)
			.$patch({
				body: {
					id: Number(form.get('id')),
					date: dateF.toString(),
					title: titleF.toString(),
					content: contentF.toString()
				}
			});
		//responseが帰ってくる時点で200確定(ほかは例外投げるので無条件リダイレクトで良い)
		throw redirect(303, '/diary/' + event.params.date);
	},
	delete: async (event: RequestEvent) => {
		const urlDate = event?.params?.date;
		if (urlDate === undefined) {
			throw new Error('invalid request');
		}
		await aApiClient({
			event: event
		})
			.api.v1.diary._date(urlDate)
			.$delete();
		throw redirect(307, '/home');
	}
} satisfies Actions;
