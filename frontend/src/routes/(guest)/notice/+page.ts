// import type { OsiraseType } from '$lib/types/Osirase';
import { apiUrlResolver } from '$lib/utils/apiUrlResolver';
export async function load({ fetch }) {
	const response = await fetch(`${apiUrlResolver()}/api/Osirase/all`);
	const data = response.json();
	return {
		data
	};
}
