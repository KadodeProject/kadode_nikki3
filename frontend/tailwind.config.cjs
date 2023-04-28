const { fontFamily } = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
module.exports = {
	mode: 'jit',
	content: ['./src/**/*.{html,js,svelte,ts}'],
	darkMode: 'class', // mediaはos依存に自動でなるため手動で変えられうようにclassへ
	theme: {
		extend: {
			fontFamily: {
				sans: ['var(--font-kiwi-maru)', ...fontFamily.sans],
				'kiwi-maru': ['var(--font-kiwi-maru)']
			}
		},
		colors: {
			// ダークテーマで色味が変わる部分
			white: 'var(--kn-default-text-color)',
			black: 'var(--kn-default-background-color)',
			purple: 'var(--kn-purple)',
			blue: 'var(--kn-blue)',
			brown: 'var(--kb-brown)',
			// ダークテーマに影響されない部分↓
			'kn-black': 'var(--kn-black)',
			'kn-white': 'var(--kn-white)',
			'kn-s-1': 'var(--kn-s-1)',
			'kn-s-2': 'var(--kn-s-2)',
			'kn-s-3': 'var(--kn-s-3)',
			'kn-a-yellow': 'var(--kn-a-yellow)',
			'kn-a-light-blue': 'var(--kn-a-light-blue)',
			'kn-a-green': 'var(--kn-a-green)'
		}
	},
	variants: {
		extend: {}
	},
	plugins: []
};
