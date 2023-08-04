import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './v1/Osirase/all';
import type { Methods as Methods1 } from './v1/Osirase/latest';
import type { Methods as Methods2 } from './v1/ReleaseNote/all';
import type { Methods as Methods3 } from './v1/ReleaseNote/latest';
import type { Methods as Methods4 } from './v1/status';
import type { Methods as Methods5 } from './v1/user/init';

const api = <T>({ baseURL, fetch }: AspidaClient<T>) => {
	const prefix = (baseURL === undefined ? 'http://localhost:2010' : baseURL).replace(/\/$/, '');
	const PATH0 = '/api/v1/Osirase/all';
	const PATH1 = '/api/v1/Osirase/latest';
	const PATH2 = '/api/v1/ReleaseNote/all';
	const PATH3 = '/api/v1/ReleaseNote/latest';
	const PATH4 = '/api/v1/status';
	const PATH5 = '/api/v1/user/init';
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
				},
				latest: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods1['get']['resBody'], BasicHeaders, Methods1['get']['status']>(
							prefix,
							PATH1,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods1['get']['resBody'], BasicHeaders, Methods1['get']['status']>(
							prefix,
							PATH1,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH1}`
				}
			},
			ReleaseNote: {
				all: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(
							prefix,
							PATH2,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods2['get']['resBody'], BasicHeaders, Methods2['get']['status']>(
							prefix,
							PATH2,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH2}`
				},
				latest: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods3['get']['resBody'], BasicHeaders, Methods3['get']['status']>(
							prefix,
							PATH3,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods3['get']['resBody'], BasicHeaders, Methods3['get']['status']>(
							prefix,
							PATH3,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH3}`
				}
			},
			status: {
				/**
				 * @returns 成功レスポンス
				 */
				get: (option?: { config?: T | undefined } | undefined) =>
					fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(
						prefix,
						PATH4,
						GET,
						option
					).json(),
				/**
				 * @returns 成功レスポンス
				 */
				$get: (option?: { config?: T | undefined } | undefined) =>
					fetch<Methods4['get']['resBody'], BasicHeaders, Methods4['get']['status']>(
						prefix,
						PATH4,
						GET,
						option
					)
						.json()
						.then((r) => r.body),
				$path: () => `${prefix}${PATH4}`
			},
			user: {
				init: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods5['get']['resBody'], BasicHeaders, Methods5['get']['status']>(
							prefix,
							PATH5,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods5['get']['resBody'], BasicHeaders, Methods5['get']['status']>(
							prefix,
							PATH5,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH5}`
				}
			}
		}
	};
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
