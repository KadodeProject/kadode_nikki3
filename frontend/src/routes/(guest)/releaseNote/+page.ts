import { gApiClient } from '$src/lib/utils/client/backendGuestApiClient';
export async function load() {
	const response = await gApiClient().api.v1.releaseNote.all.$get();
	return {
		response
	};
}
