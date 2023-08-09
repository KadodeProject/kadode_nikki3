export type UserStore = {
	id: number;
	name: string;
	isGuest: boolean; // ログインしていないユーザーもユーザーとして扱うほうが都合が良い
};
