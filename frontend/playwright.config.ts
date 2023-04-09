import type { PlaywrightTestConfig } from '@playwright/test';
import { devices } from '@playwright/test';
const config: PlaywrightTestConfig = {
	webServer: {
		command: 'pnpm build && pnpm preview',
		port: 4173
	},
	testDir: 'tests/integration',
	reporter: process.env.CI ? 'github' : 'html',
	// workersは増やしてもコア数が足りないと重くなるのでそのまにする
	projects: [
		{
			name: 'chromium',
			use: {
				...devices['Desktop Chrome']
			}
		},

		{
			name: 'firefox',
			use: {
				...devices['Desktop Firefox']
			}
		},

		{
			name: 'webkit',
			use: {
				...devices['Desktop Safari']
			}
		},

		/* Test against mobile viewports. */
		{
			name: 'Mobile Chrome',
			use: {
				...devices['Pixel 5']
			}
		},
		{
			name: 'Mobile Safari',
			use: {
				...devices['iPhone 12']
			}
		}

		/* Test against branded browsers.←chromiumやってるので省略する */
		// {
		//   name: 'Microsoft Edge',
		//   use: {
		//     channel: 'msedge',
		//   },
		// },
		// {
		//   name: 'Google Chrome',
		//   use: {
		//     channel: 'chrome',
		//   },
		// },
	]
};

export default config;
