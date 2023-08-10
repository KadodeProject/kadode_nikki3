/* eslint-disable */
export type Affiliation = {
  /** 単語開始位置 */
  start?: number | undefined
  /** 単語終了位置 */
  end?: number | undefined
  /** 単語の原型 */
  lemma?: string | undefined
  /** 分類(関根の拡張固有表現階層 ver7.1.2ベース) */
  form?: string | undefined
}[]

export type Chunk = {
  /** 形態論情報 */
  dependencyTag?: string | undefined
  /** 該当単語 */
  dependencyTxt?: string | undefined
  /** 係り先 */
  dependencyForId?: number | undefined
  /** 係り先の単語 */
  dependencyForTxt?: string | undefined
}[]

export type Token = {
  /** 単語開始位置 */
  start?: number | undefined
  /** 単語終了位置 */
  end?: number | undefined
  /** 単語本体 */
  form?: string | undefined
  /** 単語の原型 */
  lemma?: string | undefined
  /** Universal Part-Of-Speech Tag/自然言語共通のタグ */
  uPOSTag?: string | undefined
  /** Language-Specific Part-Of-Speech Tag/日本語の品詞 */
  xPOSTag?: string | undefined
  /** 未知判定 */
  isUnknown?: boolean | undefined
}[]

export type Diary_processed = {
  id?: number | undefined
  diary_id?: number | undefined
  statistic_progress?: number | undefined
  sentence?: Sentence | undefined
  chunk?: Chunk | undefined
  token?: Token | undefined
  affiliation?: Affiliation | undefined
  char_length?: number | undefined
  created_at?: string | undefined
  updated_at?: string | undefined
} | null

export type Sentence = {
  /** 終了位置 */
  end?: number | undefined
  /** 開始位置 */
  start?: number | undefined
}[]

export type Statistic_per_date = {
  id?: number | undefined
  diary_id?: number | undefined
  statistic_progress?: number | undefined
  emotions?: number | undefined
  classification?: string | undefined
  important_words?: Important_words | undefined
  special_people?: Special_people | undefined
  created_at?: string | undefined
  updated_at?: string | undefined
} | null

export type Diary = {
  id?: number | undefined
  date?: string | undefined
  title?: string | undefined
  contente?: string | undefined
  updated_at?: string | undefined
  statisticStatus?: number | undefined
  statistic_per_date?: Statistic_per_date | undefined
  diary_processed?: Diary_processed | undefined
}

export type Osirase = {
  title?: string | undefined
  date?: string | undefined
  /** 改行含む文字列が入ってくるがエスケープなどはされていない */
  description?: string | undefined
  url?: string | undefined
}[]

export type User = {
  id?: number | undefined
  name?: string | undefined
}

export type Statistic = {
  id?: number | undefined
  user_id?: number | undefined
  statistic_progress?: number | undefined
  month_words?: Date | undefined
  month_diaries?: Date | undefined
  year_words?: Date | undefined
  year_diaries?: Date | undefined
  /** 合計文字数 */
  total_words?: number | undefined
  /** 合計日記数 */
  total_diaries?: number | undefined
  total_noun_asc?: Words_count_schema | undefined
  total_adjective_asc?: Words_count_schema | undefined
  emotions?: Emotions | undefined
  classifications?: Words_count_schema | undefined
  special_people?: Words_count_schema | undefined
  important_words?: Words_count_schema | undefined
  created_at?: string | undefined
  updated_at?: string | undefined
} | null

export type Important_words = {
  /** 単語 */
  name?: string | undefined
  count?: number | undefined
}[]

/** keyに2022-04のように月が入る */
export type Date = {
  /** 数 */
  [key: string]: number | undefined
}

export type Special_people = {
  /** 人物名 */
  name?: string | undefined
  count?: number | undefined
}[]

export type Emotions = {
  /** 年月 */
  date?: string | undefined
  value?: number | undefined
}[]

export type Words_count_schema = {
  /** 単語 */
  name?: string | undefined
  count?: number | undefined
}[]

export type ReleaseNote = {
  title?: string | undefined
  date?: string | undefined
  /** 改行含む文字列が入ってくるがエスケープなどはされていない */
  description?: string | undefined
  url?: string | undefined
}[]
