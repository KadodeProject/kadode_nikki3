<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
	/**
	 * App\Models\Appearance
	 *
	 * @property int $id
	 * @property string $name 見た目名
	 * @property string|null $description 説明
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Appearance whereName($value)
	 */
	class Appearance extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\CustomNER
	 *
	 * @property int $id
	 * @property int $user_id 登録しているユーザーID
	 * @property int $label_id ラベルのID
	 * @property string $name 名前
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER query()
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereLabelId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|CustomNER whereUserId($value)
	 */
	class CustomNER extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Diary
	 *
	 * @property int $id
	 * @property string $uuid uuid
	 * @property int $user_id ユーザーID
	 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
	 * @property string|null $title タイトル
	 * @property string $content 本文
	 * @property \Illuminate\Support\Carbon $date 日記の日付
	 * @property mixed|null $sentence 一文ごとの位置(係り受けで使う)
	 * @property mixed|null $chunk 係り受け構造
	 * @property mixed|null $token 形態素分析された中身を格納 品詞(POS)、原形(lemma)などが存在
	 * @property mixed|null $affiliation 固有表現抽出
	 * @property int|null $char_length 文字数
	 * @property mixed|null $meta_info 事実上予備領域
	 * @property mixed|null $similar_sentences 似ている日記の日記ID(5)
	 * @property float|null $emotions 感情数値化
	 * @property float|null $flavor ユーザーの日記らしさ
	 * @property string|null $classification 推定分類
	 * @property mixed|null $important_words 重要そうな言葉(top3)
	 * @property mixed|null $cause_effect_sentences 原因と結果のjson
	 * @property mixed|null $special_people 登場人物
	 * @property string|null $updated_statistic_at 統計更新日時
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereAffiliation($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereCauseEffectSentences($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereCharLength($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereChunk($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereClassification($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereContent($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereEmotions($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereFlavor($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereImportantWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereMetaInfo($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereSentence($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereSimilarSentences($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereSpecialPeople($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereStatisticProgress($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereToken($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUpdatedStatisticAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUuid($value)
	 */
	class Diary extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Diary_people
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property string $name 名前
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Diary_people whereUserId($value)
	 */
	class Diary_people extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\NERLabel
	 *
	 * @property int $id
	 * @property string $label ラベル(正式英名)
	 * @property string $name ラベル(日本語名)
	 * @property string|null $parent 大分類名
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel query()
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel whereLabel($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NERLabel whereParent($value)
	 */
	class NERLabel extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\NlpPackageGenre
	 *
	 * @property int $id
	 * @property string $name ジャンル名
	 * @property string|null $description 説明
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre query()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageGenre whereUpdatedAt($value)
	 */
	class NlpPackageGenre extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\NlpPackageName
	 *
	 * @property int $id
	 * @property int $genre_id パッケージのジャンルID
	 * @property int $user_id 作成ユーザーID
	 * @property string $name パッケージ名
	 * @property string $is_publish 公開設定
	 * @property string|null $description 説明
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName query()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereGenreId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereIsPublish($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageName whereUserId($value)
	 */
	class NlpPackageName extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\NlpPackageUser
	 *
	 * @property int $id
	 * @property int $user_id 所有ユーザー
	 * @property int $package_id パッケージ
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser query()
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser wherePackageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|NlpPackageUser whereUserId($value)
	 */
	class NlpPackageUser extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Osirase
	 *
	 * @property int $id
	 * @property string $title タイトル
	 * @property int $genre_id お知らせのジャンルID
	 * @property string $description 説明
	 * @property \Illuminate\Support\Carbon $date 日付
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\Osirase_genre $osirase_genre
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereGenreId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase whereUpdatedAt($value)
	 */
	class Osirase extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Osirase_genre
	 *
	 * @property int $id
	 * @property string $name ジャンル名
	 * @property string|null $description 説明
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Osirase_genre whereName($value)
	 */
	class Osirase_genre extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\PackageNER
	 *
	 * @property int $id
	 * @property int $package_id 登録しているパッケージの名前
	 * @property int $label_id ラベルのID
	 * @property string $name 名前
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER query()
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER whereLabelId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER wherePackageId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PackageNER whereUpdatedAt($value)
	 */
	class PackageNER extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Releasenote
	 *
	 * @property int $id
	 * @property string $title タイトル
	 * @property int $genre_id リリースノートのジャンルID
	 * @property string $description 説明
	 * @property \Illuminate\Support\Carbon $date 日付
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\Releasenote_genre $releasenote_genre
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereDate($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereGenreId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote whereUpdatedAt($value)
	 */
	class Releasenote extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Releasenote_genre
	 *
	 * @property int $id
	 * @property string $name ジャンル名
	 * @property string|null $description 説明
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Releasenote_genre whereName($value)
	 */
	class Releasenote_genre extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Search_setting
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property string|null $rank 検索順位の選び方
	 * @property string|null $kinds 検索種別(AND,OR)
	 * @property int|null $is_morphological 形態素解析するか？
	 * @property int|null $is_synonym 同義語展開するか？
	 * @property int|null $is_kana かなカナ展開するか？
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereIsKana($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereIsMorphological($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereIsSynonym($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereKinds($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Search_setting whereUserId($value)
	 */
	class Search_setting extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Statistic
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
	 * @property mixed|null $month_words 各月の合計文字数
	 * @property mixed|null $month_diaries 各月の合計日記数
	 * @property mixed|null $year_words 各年の合計文字数
	 * @property mixed|null $year_diaries 各年の合計日記数
	 * @property int|null $total_words トータル文字数
	 * @property int|null $total_diaries トータル日記数
	 * @property mixed|null $total_noun_asc トータルの名詞トップ50
	 * @property mixed|null $total_adjective_asc トータルの形容詞トップ50
	 * @property mixed|null $diary_grass 日記投稿頻度閲覧用
	 * @property mixed|null $emotions 感情数値化のグラフと平均用json
	 * @property mixed|null $classifications 推定分類(top10)
	 * @property mixed|null $special_people 登場人物(top10)
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property mixed|null $important_words 重要そうな言葉
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereClassifications($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereDiaryGrass($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereEmotions($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereImportantWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereMonthDiaries($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereMonthWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereSpecialPeople($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereStatisticProgress($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalAdjectiveAsc($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalDiaries($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalNounAsc($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTotalWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereUserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereYearDiaries($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereYearWords($value)
	 */
	class Statistic extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Statistic_overall_progress
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property string|null $progress_chr 進行状況
	 * @property float|null $progress_ration 進行率
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereProgressChr($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereProgressRation($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_overall_progress whereUserId($value)
	 */
	class Statistic_overall_progress extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Statistic_per_month
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
	 * @property int $year 年
	 * @property int $month 月
	 * @property mixed|null $emotions 感情数値化ののグラフと平均用json
	 * @property mixed|null $word_counts 文字数推移のグラフ用の数値json
	 * @property mixed|null $noun_rank 名詞登場順(top10)
	 * @property mixed|null $adjective_rank 形容詞登場順(top10)
	 * @property mixed|null $important_words 重要な言葉(top3)
	 * @property mixed|null $special_people 登場人物(top3)
	 * @property mixed|null $classifications 推定分類(top3)
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereAdjectiveRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereClassifications($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereEmotions($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereImportantWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereMonth($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereNounRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereSpecialPeople($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereStatisticProgress($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereUserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereWordCounts($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_month whereYear($value)
	 */
	class Statistic_per_month extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Statistic_per_year
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
	 * @property int $year 年
	 * @property mixed|null $emotions 感情数値化のグラフと平均用json
	 * @property mixed|null $word_counts 文字数推移のグラフ用の数値json
	 * @property mixed|null $noun_rank 名詞登場順(top20)
	 * @property mixed|null $adjective_rank 形容詞登場順(top20)
	 * @property mixed|null $important_words 重要な言葉(top10)
	 * @property mixed|null $special_people 登場人物(top10)
	 * @property mixed|null $classifications 推定分類(top10)
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereAdjectiveRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereClassifications($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereEmotions($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereImportantWords($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereNounRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereSpecialPeople($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereStatisticProgress($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereUserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereWordCounts($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Statistic_per_year whereYear($value)
	 */
	class Statistic_per_year extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $email
	 * @property \Illuminate\Support\Carbon|null $email_verified_at
	 * @property string $password
	 * @property string|null $two_factor_secret
	 * @property string|null $two_factor_recovery_codes
	 * @property string|null $remember_token
	 * @property int|null $current_team_id
	 * @property string|null $profile_photo_path
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property int|null $is_showed_update_user_rank ユーザーランクの更新通知フラグ
	 * @property int|null $is_showed_update_system_info アップデート情報更新通知フラグ
	 * @property int|null $is_showed_service_info お知らせ通知フラグ
	 * @property int|null $user_rank_id ユーザーランク
	 * @property int|null $user_role_id ユーザーロール(一般、管理者etc)
	 * @property int|null $appearance_id ページの見た目
	 * @property \Illuminate\Support\Carbon|null $user_rank_updated_at ユーザーランクアップデート日
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Diary[] $diary
	 * @property-read int|null $diary_count
	 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
	 * @property-read int|null $notifications_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
	 * @property-read int|null $tokens_count
	 * @property-read \App\Models\User_rank|null $user_rank
	 * @property-read \App\Models\User_role|null $user_role
	 * @method static \Database\Factories\UserFactory factory(...$parameters)
	 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppearanceId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsShowedServiceInfo($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsShowedUpdateSystemInfo($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsShowedUpdateUserRank($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserRankId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserRankUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserRoleId($value)
	 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User_ip
	 *
	 * @property int $id
	 * @property int $user_id ユーザーID
	 * @property string $ip ipアドレス
	 * @property string $ua ユーザーエージェント
	 * @property string $geo タイトル
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereGeo($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereIp($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereUa($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_ip whereUserId($value)
	 */
	class User_ip extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User_rank
	 *
	 * @property int $id
	 * @property string $name ユーザーランク名
	 * @property string|null $description 説明
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_rank whereName($value)
	 */
	class User_rank extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User_role
	 *
	 * @property int $id
	 * @property string $name ユーザーロール名
	 * @property string|null $description 説明
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User_role whereName($value)
	 */
	class User_role extends \Eloquent
	{
	}
}