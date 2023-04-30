// ホームの一番上に出てくる見開き(直近の日記表示)コーナーで使う日記の型
export type MihirakiContentType = {
	id: number;
	date: string;
	title: string;
	content: string;
	updated_at: string;
	statisticStatus: number;
	statistic_per_date?: string;
};

// アーカイブやホーム下など日記の表示で最もよく使うデータ
export type ArchiveDiaryType = {
	id: number;
	date: string;
	title: string;
	content: string;
	updated_at: string;
	// 自然言語処理関連
	sentence?: JSON;
	chunk?: JSON;
	token?: JSON;
	affiliation?: JSON;
	char_length: number;
	// 処理済みの統計関連
	statisticStatus: number;
	statistic_per_date?: string;
	emotion?: number;
	classfications?: string;
	important_words?: JSON;
	special_people?: JSON;
};
