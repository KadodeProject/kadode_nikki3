/// <reference types="vitest" />
import { sveltekit } from '@sveltejs/kit/vite';
import svg from '@poppanator/sveltekit-svg';
import type { UserConfig } from 'vite';

const config: UserConfig = {
	plugins: [sveltekit(), svg()],
	build: {
		target: 'esnext'
	},
	test: {
		globals: true,
		environment: 'jsdom',
		include: ['./tests/unit/**/*.vitest.ts']
	}
};

export default config;
