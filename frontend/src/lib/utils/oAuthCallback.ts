import { env } from '$env/dynamic/public';

const callbackFromApi = async (provider: string) => {
	const response = await fetch(`${env.PUBLIC_API_CLIENT_SIDE_URL}/api/login/${provider}`);
	if (response.status !== 200) throw new Error('Failed to fetch');
	const data = await response.json();
	window.location.href = data.redirect_url;
};

export const callbackGoogle = async () => {
	await callbackFromApi('google');
};

export const callbackGitHub = async () => {
	await callbackFromApi('github');
};
