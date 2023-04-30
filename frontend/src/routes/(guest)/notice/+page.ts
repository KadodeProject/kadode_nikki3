// import type { OsiraseType } from '$lib/types/Osirase';
import { env } from '$env/dynamic/public';
export async function load({ fetch }) {
	const response = await fetch(`${env.PUBLIC_BASE_API}/api/Osirase/all`);
	const data = response.json();
	return {
		data
	};
}
