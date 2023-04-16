import { env } from '$env/dynamic/public';
import { userStore } from '$lib/stores/userStore';
import { redirect, type RequestEvent } from '@sveltejs/kit';
import axios from 'axios';
import setCookieParser from 'set-cookie-parser';
import type { Actions } from './$types';
export const actions: Actions = {
	login: async (event: RequestEvent) => {
		const base = env.PUBLIC_BASE_API;
		const form = await event.request.formData();
		try {
			const { status, headers } = await axios.get(`${base}/sanctum/csrf-cookie`, {
				withCredentials: true
			});
			// ここでError投げているが404とかだとaxios側で例外がスローされる。
			if (status !== 204) {
				throw new Error('トークンの取得に失敗しました');
			}
			const setCookieHeader = headers ? headers['set-cookie'] : undefined;
			const cookies = setCookieParser.parse(setCookieHeader as readonly string[]);
			const xsrfToken = cookies[0];
			const session = cookies[1];
			const {
				data,
				status: statusAfterLogin,
				headers: headersAfterLogin
			} = await axios.post(
				`${base}/login`,
				{
					email: form.has('email') ? form.get('email') : undefined,
					password: form.has('password') ? form.get('password') : undefined
				},
				{
					withCredentials: true,
					headers: {
						'content-type': 'application/json',
						accept: 'application/json',
						'X-XSRF-TOKEN': xsrfToken.value,
						cookie:
							(event?.request?.headers?.get('cookie') as string) +
							'; ' +
							xsrfToken.name +
							'=' +
							xsrfToken.value +
							'; ' +
							session.name +
							'=' +
							session.value
					}
				}
			);
			if (statusAfterLogin !== 200) {
				throw new Error('ログインに失敗しました');
			}
			const setCookieHeaderAfterLogin = headersAfterLogin
				? headersAfterLogin['set-cookie']
				: undefined;
			const cookiesLoggedIn = setCookieParser.parse(
				setCookieHeaderAfterLogin as readonly string[]
			);
			const xsrfTokenLoggedIn = cookiesLoggedIn[0];
			const sessionLoggedIn = cookiesLoggedIn[1];

			event.cookies.set(xsrfTokenLoggedIn.name, xsrfTokenLoggedIn.value, {
				path: '/',
				maxAge: xsrfTokenLoggedIn.maxAge,
				httpOnly: xsrfTokenLoggedIn.httpOnly,
				secure: xsrfTokenLoggedIn.secure,
				sameSite: xsrfTokenLoggedIn.sameSite as 'lax' | 'strict' | 'none' | undefined
			});
			event.cookies.set(sessionLoggedIn.name, sessionLoggedIn.value, {
				path: '/',
				maxAge: sessionLoggedIn.maxAge,
				httpOnly: sessionLoggedIn.httpOnly,
				secure: sessionLoggedIn.secure,
				sameSite: sessionLoggedIn.sameSite as 'lax' | 'strict' | 'none' | undefined
			});
			userStore.set({
				id: data.id,
				name: data.name
			});
		} catch (error) {
			console.error(error);
			return {
				status: 500,
				body: { message: 'Internal Server Error' }
			};
		}
		throw redirect(302, '/home');

		// //csrfトークンを取得してセットする
		// const response_pre = await backendApiAdapter({
		//     method: 'get',
		//     resource: 'sanctum/csrf-cookie',
		//     event,
		// });
		// const splitCookieHeaders  = setCookieParser.splitCookiesString(response_pre.headers.get('set-cookie')) ;
		// const cookies = setCookieParser.parse(splitCookieHeaders);
		// const xsrfToken =cookies[0];
		// const session =cookies[1];

		// // console.log(response_pre.headers.get('set-cookie'));
		// event.locals.session = session;
		// event.cookies.set(xsrfToken.name, xsrfToken.value, {
		//     path: '/',
		//     maxAge: xsrfToken.maxAge,
		//     httpOnly: xsrfToken.httpOnly,
		//     secure: xsrfToken.secure,
		//     sameSite: xsrfToken.sameSite,
		//     });
		// event.cookies.set(session.name, session.value, {
		//     path: '/',
		//     maxAge: session.maxAge,
		//     httpOnly: session.httpOnly,
		//     secure: session.secure,
		//     sameSite: session.sameSite,
		//     });

		// const response = await backendApiAdapter({
		// 	method: 'post',
		// 	resource: 'login',
		// 	data: {
		// 		'email': form.has('email') ? form.get('email') : undefined,
		// 		'password': form.has('password') ? form.get('password') : undefined,
		// 	},
		// 	event,
		// });
		// console.log("response body",response)
	}
};
