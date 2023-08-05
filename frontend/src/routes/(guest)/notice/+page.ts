import api from '$apiSchema/$api';
import aspida from '@aspida/node-fetch';
import { aspidaFetchConfig } from '$src/lib/config/aspidaFetchConfig';
export async function load() {
    const client = api(aspida(fetch, aspidaFetchConfig));
	const response = await client.api.v1.osirase.all.$get();
    return {
        response
    };
}
