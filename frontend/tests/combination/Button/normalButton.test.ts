import { expect, test } from '@playwright/experimental-ct-svelte';
import NormalButton from '../../../src/lib/components/atom/button/NormalButton.svelte';
test.describe('ボタンの表示テスト', () => {
	test('normalButton.svelte', async ({ mount }) => {
		const component = await mount(NormalButton, { props: { title: 'ボタン名' } });
		const paragraph = component.locator('p');
		await expect(await paragraph.textContent()).toBe('ボタン名');
	});
});
