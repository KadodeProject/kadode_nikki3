import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './v1/Osirase/all';

const api = <T>({ baseURL, fetch }: AspidaClient<T>) => {
	const prefix = (baseURL === undefined ? 'http://localhost:2010' : baseURL).replace(/\/$/, '');
	const PATH0 = '/api/v1/Osirase/all';
	const GET = 'GET';

	return {
		v1: {
			Osirase: {
				all: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods0['get']['resBody'], BasicHeaders, Methods0['get']['status']>(
							prefix,
							PATH0,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods0['get']['resBody'], BasicHeaders, Methods0['get']['status']>(
							prefix,
							PATH0,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH0}`
				}
			}
		}
	};
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
