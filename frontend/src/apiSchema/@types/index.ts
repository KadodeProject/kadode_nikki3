/* eslint-disable */
export type DiaryRequestBody = {
	date?: number | undefined;
	title?: string | undefined;
	content?: string | undefined;
};

export type Osirase = {
	title?: string | undefined;
	date?: string | undefined;
	/** 改行含む文字列が入ってくるがエスケープなどはされていない */
	description?: string | undefined;
	url?: string | undefined;
}[];

export type User = {
	id?: number | undefined;
	name?: string | undefined;
};

export type ReleaseNote = {
	title?: string | undefined;
	date?: string | undefined;
	/** 改行含む文字列が入ってくるがエスケープなどはされていない */
	description?: string | undefined;
	url?: string | undefined;
}[];
