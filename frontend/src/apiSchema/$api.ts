// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-nocheck
import type { AspidaClient, BasicHeaders } from 'aspida';
import type { Methods as Methods0 } from './api/v1/Osirase/all';
import type { Methods as Methods1 } from './api/v1/Osirase/latest';
import type { Methods as Methods2 } from './api/v1/ReleaseNote/all';
import type { Methods as Methods3 } from './api/v1/ReleaseNote/latest';
import type { Methods as Methods4 } from './api/v1/auth/_provider@string/callback';
import type { Methods as Methods5 } from './api/v1/diary';
import type { Methods as Methods6 } from './api/v1/home';
import type { Methods as Methods7 } from './api/v1/login/_provider@string';
import type { Methods as Methods8 } from './api/v1/status';
import type { Methods as Methods9 } from './api/v1/user/init';

const api = <T>({ baseURL, fetch }: AspidaClient<T>) => {
	const prefix = (baseURL === undefined ? 'https://api.kado.day' : baseURL).replace(/\/$/, '');
	const PATH0 = '/api/v1/Osirase/all';
	const PATH1 = '/api/v1/Osirase/latest';
	const PATH2 = '/api/v1/ReleaseNote/all';
	const PATH3 = '/api/v1/ReleaseNote/latest';
	const PATH4 = '/api/v1/auth';
	const PATH5 = '/callback';
	const PATH6 = '/api/v1/diary';
	const PATH7 = '/api/v1/home';
	const PATH8 = '/api/v1/login';
	const PATH9 = '/api/v1/status';
	const PATH10 = '/api/v1/user/init';
	const GET = 'GET';
	const POST = 'POST';

	return {
		api: {
			v1: {
				Osirase: {
					all: {
						/**
						 * @returns 成功レスポンス
						 */
						get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods0['get']['resBody'],
								BasicHeaders,
								Methods0['get']['status']
							>(prefix, PATH0, GET, option).json(),
						/**
						 * @returns 成功レスポンス
						 */
						$get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods0['get']['resBody'],
								BasicHeaders,
								Methods0['get']['status']
							>(prefix, PATH0, GET, option)
								.json()
								.then((r) => r.body),
						$path: () => `${prefix}${PATH0}`
					},
					latest: {
						/**
						 * @returns 成功レスポンス
						 */
						get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods1['get']['resBody'],
								BasicHeaders,
								Methods1['get']['status']
							>(prefix, PATH1, GET, option).json(),
						/**
						 * @returns 成功レスポンス
						 */
						$get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods1['get']['resBody'],
								BasicHeaders,
								Methods1['get']['status']
							>(prefix, PATH1, GET, option)
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
							fetch<
								Methods2['get']['resBody'],
								BasicHeaders,
								Methods2['get']['status']
							>(prefix, PATH2, GET, option).json(),
						/**
						 * @returns 成功レスポンス
						 */
						$get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods2['get']['resBody'],
								BasicHeaders,
								Methods2['get']['status']
							>(prefix, PATH2, GET, option)
								.json()
								.then((r) => r.body),
						$path: () => `${prefix}${PATH2}`
					},
					latest: {
						/**
						 * @returns 成功レスポンス
						 */
						get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods3['get']['resBody'],
								BasicHeaders,
								Methods3['get']['status']
							>(prefix, PATH3, GET, option).json(),
						/**
						 * @returns 成功レスポンス
						 */
						$get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods3['get']['resBody'],
								BasicHeaders,
								Methods3['get']['status']
							>(prefix, PATH3, GET, option)
								.json()
								.then((r) => r.body),
						$path: () => `${prefix}${PATH3}`
					}
				},
				auth: {
					_provider: (val3: string) => {
						const prefix3 = `${PATH4}/${val3}`;

						return {
							callback: {
								get: (option?: { config?: T | undefined } | undefined) =>
									fetch<void, BasicHeaders, Methods4['get']['status']>(
										prefix,
										`${prefix3}${PATH5}`,
										GET,
										option
									).send(),
								$get: (option?: { config?: T | undefined } | undefined) =>
									fetch<void, BasicHeaders, Methods4['get']['status']>(
										prefix,
										`${prefix3}${PATH5}`,
										GET,
										option
									)
										.send()
										.then((r) => r.body),
								$path: () => `${prefix}${prefix3}${PATH5}`
							}
						};
					}
				},
				diary: {
					/**
					 * @returns 成功レスポンス
					 */
					post: (option: { body: Methods5['post']['reqBody']; config?: T | undefined }) =>
						fetch<
							Methods5['post']['resBody'],
							BasicHeaders,
							Methods5['post']['status']
						>(prefix, PATH6, POST, option).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$post: (option: {
						body: Methods5['post']['reqBody'];
						config?: T | undefined;
					}) =>
						fetch<
							Methods5['post']['resBody'],
							BasicHeaders,
							Methods5['post']['status']
						>(prefix, PATH6, POST, option)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH6}`
				},
				home: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods6['get']['resBody'], BasicHeaders, Methods6['get']['status']>(
							prefix,
							PATH7,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods6['get']['resBody'], BasicHeaders, Methods6['get']['status']>(
							prefix,
							PATH7,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH7}`
				},
				login: {
					_provider: (val3: string) => {
						const prefix3 = `${PATH8}/${val3}`;

						return {
							/**
							 * @returns 成功レスポンス
							 */
							get: (option?: { config?: T | undefined } | undefined) =>
								fetch<
									Methods7['get']['resBody'],
									BasicHeaders,
									Methods7['get']['status']
								>(prefix, prefix3, GET, option).json(),
							/**
							 * @returns 成功レスポンス
							 */
							$get: (option?: { config?: T | undefined } | undefined) =>
								fetch<
									Methods7['get']['resBody'],
									BasicHeaders,
									Methods7['get']['status']
								>(prefix, prefix3, GET, option)
									.json()
									.then((r) => r.body),
							$path: () => `${prefix}${prefix3}`
						};
					}
				},
				status: {
					/**
					 * @returns 成功レスポンス
					 */
					get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods8['get']['resBody'], BasicHeaders, Methods8['get']['status']>(
							prefix,
							PATH9,
							GET,
							option
						).json(),
					/**
					 * @returns 成功レスポンス
					 */
					$get: (option?: { config?: T | undefined } | undefined) =>
						fetch<Methods8['get']['resBody'], BasicHeaders, Methods8['get']['status']>(
							prefix,
							PATH9,
							GET,
							option
						)
							.json()
							.then((r) => r.body),
					$path: () => `${prefix}${PATH9}`
				},
				user: {
					init: {
						/**
						 * @returns 成功レスポンス
						 */
						get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods9['get']['resBody'],
								BasicHeaders,
								Methods9['get']['status']
							>(prefix, PATH10, GET, option).json(),
						/**
						 * @returns 成功レスポンス
						 */
						$get: (option?: { config?: T | undefined } | undefined) =>
							fetch<
								Methods9['get']['resBody'],
								BasicHeaders,
								Methods9['get']['status']
							>(prefix, PATH10, GET, option)
								.json()
								.then((r) => r.body),
						$path: () => `${prefix}${PATH10}`
					}
				}
			}
		}
	};
};

export type ApiInstance = ReturnType<typeof api>;
export default api;
