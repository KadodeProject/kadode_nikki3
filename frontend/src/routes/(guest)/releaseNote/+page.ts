import api from '$apiSchema/$api';
import { aspidaFetchConfig } from '$src/lib/config/aspidaFetchConfig';
import aspida from '@aspida/node-fetch';
export async function load() {
    const client = api(aspida(fetch, aspidaFetchConfig));
    const response = await client.api.v1.releaseNote.all.$get();
    return {
        response
    };
}
