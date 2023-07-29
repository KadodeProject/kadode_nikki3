import { expect, test } from '@playwright/test';

test.describe('存在しないページで404になるかのテスト', () => {
	test('通常ページ', async ({ page }) => {
		const response = await page.goto('/nai');
		expect(response).not.toBe(null);
		if (response === null) return; //静的解析を黙らせるために意味がないがnullチェックをしている
		expect(response.status()).toBe(404);
	});

	// test('動的ルーティングページ', async ({ page }) => {
	// 	const response = await page.goto('/works/programming/nai');
	// 	expect(response).not.toBe(null);
	// 	if (response === null) return; //静的解析を黙らせるために意味がないがnullチェックをしている
	// 	expect(response.status()).toBe(404);
	// });
});
