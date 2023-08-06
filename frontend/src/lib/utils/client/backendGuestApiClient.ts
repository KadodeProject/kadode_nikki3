import { apiUrlResolver } from '$src/lib/utils/apiUrlResolver';
import api from '$apiSchema/$api';
import aspida from '@aspida/node-fetch';
import fetch from 'node-fetch';
export const gApiClient = () => {
	const aspidaFetchConfig = {
		baseURL: apiUrlResolver(),
		throwHttpErrors: true
	};
	return api(aspida(fetch, aspidaFetchConfig));
};
