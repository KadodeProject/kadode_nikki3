import { gApiClient } from '$src/lib/utils/client/backendGuestApiClient';
export async function load() {
	const response = await gApiClient().api.v1.osirase.all.$get();
	return { response };
}
