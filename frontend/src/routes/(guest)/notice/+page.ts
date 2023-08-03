// import type { OsiraseType } from '$lib/types/Osirase';
import api from '$apiSchema/$api';
import { apiUrlResolver } from '$src/lib/utils/apiUrlResolver';
import aspida from '@aspida/node-fetch';
const fetchConfig = {
	baseURL: apiUrlResolver()
};
export async function load() {
	const client = api(aspida(fetch, fetchConfig));
	const response = await client.api.v1.Osirase.all.$get();
	return {
		response
	};
}
