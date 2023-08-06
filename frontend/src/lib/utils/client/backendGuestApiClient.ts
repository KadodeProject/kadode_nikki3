import { apiUrlResolver } from '$src/lib/utils/apiUrlResolver';
import api from '$apiSchema/$api';
//node-fetchだとクライアントで動かなくなるので使わない
import aspida from '@aspida/fetch';
export const gApiClient = () => {
	const aspidaFetchConfig = {
		baseURL: apiUrlResolver(),
		throwHttpErrors: true
	};
	return api(aspida(fetch, aspidaFetchConfig));
};
