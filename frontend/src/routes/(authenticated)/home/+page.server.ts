import { backendAuthApiAdapter } from '$lib/utils/adapter/backendAuthApiAdapter';
import type { RequestEvent } from '@sveltejs/kit';
import type { MihirakiContentType, ArchiveDiaryType } from '$lib/types/Diary';
import type { HomeNotificationsType } from '$lib/types/Notification';
type Response = {
	unreadNotifications: HomeNotificationsType;
	oldDiaries: ArchiveDiaryType[];
	zeroDayAgoDiary: MihirakiContentType;
	oneDayAgoDiary: MihirakiContentType;
	twoDayAgoDiary: MihirakiContentType;
	threeDayAgoDiary: MihirakiContentType;
	latestDiaries: MihirakiContentType[];
};

export const load = async (event: RequestEvent) => {
	const response = await backendAuthApiAdapter({
		method: 'get',
		resource: 'api/home',
		event: event
	});
	const data = response as Response;
	return data;
};
