import { backendApiAdapter } from '$lib/utils/adapter/backendApiAdapter';
import type { RequestEvent } from '@sveltejs/kit';
import type { MihirakiContentType } from '$lib/types/Diary';
import type { HomeNotificationsType } from '$lib/types/Notification';
type Response = {
	unreadNotifications: HomeNotificationsType;
	oldDiaries: MihirakiContentType[];
	zeroDayAgoDiary: MihirakiContentType;
	oneDayAgoDiary: MihirakiContentType;
	twoDayAgoDiary: MihirakiContentType;
	threeDayAgoDiary: MihirakiContentType;
	latestDiaries: MihirakiContentType[];
};

export const load = async (event: RequestEvent) => {
	const response = await backendApiAdapter({
		method: 'get',
		resource: 'api/home',
		event: event
	});
	const data = response as Response;
	return data;
};
