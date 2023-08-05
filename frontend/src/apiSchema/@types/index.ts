/* eslint-disable */
export type Affiliation = {
	/** 単語開始位置 */
	start?: number | undefined;
	/** 単語終了位置 */
	end?: number | undefined;
	/** 単語の原型 */
	lemma?: string | undefined;
	/** 分類(関根の拡張固有表現階層 ver7.1.2ベース) */
	form?: string | undefined;
}[];

export type Chunk = {
	/** 形態論情報 */
	dependencyTag?: string | undefined;
	/** 該当単語 */
	dependencyTxt?: string | undefined;
	/** 係り先 */
	dependencyForId?: number | undefined;
	/** 係り先の単語 */
	dependencyForTxt?: string | undefined;
}[];

export type Token = {
	/** 単語開始位置 */
	start?: number | undefined;
	/** 単語終了位置 */
	end?: number | undefined;
	/** 単語本体 */
	form?: string | undefined;
	/** 単語の原型 */
	lemma?: string | undefined;
	/** Universal Part-Of-Speech Tag/自然言語共通のタグ */
	uPOSTag?: string | undefined;
	/** Language-Specific Part-Of-Speech Tag/日本語の品詞 */
	xPOSTag?: string | undefined;
	/** 未知判定 */
	isUnknown?: boolean | undefined;
}[];

export type Diary_processed = {
	id?: number | undefined;
	diary_id?: number | undefined;
	statistic_progress?: number | undefined;
	sentence?: Sentence | undefined;
	chunk?: Chunk | undefined;
	token?: Token | undefined;
	affiliation?: Affiliation | undefined;
	char_length?: number | undefined;
	created_at?: string | undefined;
	updated_at?: string | undefined;
} | null;

export type Sentence = {
	/** 終了位置 */
	end?: number | undefined;
	/** 開始位置 */
	start?: number | undefined;
}[];

export type Statistic_per_date = {
	id?: number | undefined;
	diary_id?: number | undefined;
	statistic_progress?: number | undefined;
	emotions?: number | undefined;
	classification?: string | undefined;
	important_words?: Important_words | undefined;
	special_people?: Special_people | undefined;
	created_at?: string | undefined;
	updated_at?: string | undefined;
} | null;

export type Diary = {
	id?: number | undefined;
	date?: string | undefined;
	title?: string | undefined;
	contente?: string | undefined;
	updated_at?: string | undefined;
	statisticStatus?: number | undefined;
	statistic_per_date?: Statistic_per_date | undefined;
	diary_processed?: Diary_processed | undefined;
};

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

export type Important_words = {
	/** 単語 */
	name?: string | undefined;
	count?: number | undefined;
}[];

export type Special_people = {
	/** 人物名 */
	name?: string | undefined;
	count?: number | undefined;
}[];

export type ReleaseNote = {
	title?: string | undefined;
	date?: string | undefined;
	/** 改行含む文字列が入ってくるがエスケープなどはされていない */
	description?: string | undefined;
	url?: string | undefined;
}[];
