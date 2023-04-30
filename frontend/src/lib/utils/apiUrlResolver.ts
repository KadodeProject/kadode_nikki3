import { env } from '$env/dynamic/public';
import { browser, dev } from '$app/environment';
/**
 * SvelteKitでサーバーサイドとクライアントサイドどちらでも実行されるfetchでAPIを叩くときに、dockerの外と中でURLが違うので、その帳尻合わせを行う関数
 */
export function apiUrlResolver(): string {
	return dev
		? browser
			? env.PUBLIC_API_CLIENT_SIDE_URL
			: env.PUBLIC_API_SERVER_SIDE_URL
		: env.PUBLIC_API_URL;
}
