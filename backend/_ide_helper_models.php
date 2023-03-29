<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class Appearance extends \Eloquent {}
}

namespace App\Models{
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
	class CustomNER extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Diary
 *
 * @property int $id
 * @property string $uuid uuid
 * @property int $user_id ユーザーID
 * @property string|null $title タイトル
 * @property string $content 本文
 * @property string $date 日記の日付
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DiaryProcessed|null $diaryProcessed
 * @property-read \App\Models\StatisticPerDate|null $statisticPerDate
 * @method static \Illuminate\Database\Eloquent\Builder|Diary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diary whereUuid($value)
 */
	class Diary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DiaryPeople
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPeople newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPeople newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPeople query()
 */
	class DiaryPeople extends \Eloquent {}
}

namespace App\Models{
/**
 * 日記の統計に使う自然言語処理データを格納する.
 *
 * @property int $id
 * @property int $diary_id 日記のid
 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
 * @property mixed|null $sentence 一文ごとの位置(係り受けで使う)
 * @property mixed|null $chunk 係り受け構造
 * @property mixed|null $token 形態素分析された中身を格納 品詞(POS)、原形(lemma)などが存在
 * @property mixed|null $affiliation 固有表現抽出
 * @property int|null $char_length 文字数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereAffiliation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereCharLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereChunk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereDiaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereSentence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereStatisticProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryProcessed whereUpdatedAt($value)
 */
	class DiaryProcessed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MachineResource
 *
 * @property int $id
 * @property string $machine マシン(サーバー)名
 * @property float $cpu CPU使用率
 * @property float $memory メモリ使用率
 * @property float $disk ディスク使用率
 * @property \Illuminate\Support\Carbon $created_at 生成日時
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereCpu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereMachine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MachineResource whereMemory($value)
 */
	class MachineResource extends \Eloquent {}
}

namespace App\Models{
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
	class NERLabel extends \Eloquent {}
}

namespace App\Models{
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
	class NlpPackageGenre extends \Eloquent {}
}

namespace App\Models{
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
	class NlpPackageName extends \Eloquent {}
}

namespace App\Models{
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
	class NlpPackageUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OperationCoreTransitionPerHour
 *
 * @property int $id
 * @property int $user_total 合計ユーザー数
 * @property int $diary_total 合計日記数
 * @property int $statistic_per_date_total 合計統計処理済み日記数
 * @property \Illuminate\Support\Carbon $created_at 生成日時
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour whereDiaryTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour whereStatisticPerDateTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCoreTransitionPerHour whereUserTotal($value)
 */
	class OperationCoreTransitionPerHour extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Osirase
 *
 * @property int $id
 * @property string $title タイトル
 * @property int $genre_id お知らせのジャンルID
 * @property string $description 説明
 * @property string $date 日付
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OsiraseGenre $osiraseGenre
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
	class Osirase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OsiraseGenre
 *
 * @property int $id
 * @property string $name ジャンル名
 * @property string|null $description 説明
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OsiraseGenre whereName($value)
 */
	class OsiraseGenre extends \Eloquent {}
}

namespace App\Models{
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
	class PackageNER extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Releasenote
 *
 * @property int $id
 * @property string $title タイトル
 * @property int $genre_id リリースノートのジャンルID
 * @property string $description 説明
 * @property string $date 日付
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ReleasenoteGenre $releasenoteGenre
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
	class Releasenote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReleasenoteGenre
 *
 * @property int $id
 * @property string $name ジャンル名
 * @property string|null $description 説明
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleasenoteGenre whereName($value)
 */
	class ReleasenoteGenre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SearchSetting
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
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereIsKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereIsMorphological($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereIsSynonym($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereKinds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchSetting whereUserId($value)
 */
	class SearchSetting extends \Eloquent {}
}

namespace App\Models{
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
	class Statistic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatisticOverallProgress
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticOverallProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticOverallProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticOverallProgress query()
 */
	class StatisticOverallProgress extends \Eloquent {}
}

namespace App\Models{
/**
 * 日記の統計に使うデータを格納する.
 *
 * @property int $id
 * @property int $diary_id 日記のid
 * @property int|null $statistic_progress 生成状況(生成まで時間かかるので)
 * @property float|null $emotions 感情数値化
 * @property string|null $classification 推定分類
 * @property mixed|null $important_words 重要そうな言葉(top3)
 * @property mixed|null $special_people 登場人物
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereDiaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereEmotions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereImportantWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereSpecialPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereStatisticProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerDate whereUpdatedAt($value)
 */
	class StatisticPerDate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatisticPerMonth
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
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereAdjectiveRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereClassifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereEmotions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereImportantWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereNounRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereSpecialPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereStatisticProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereWordCounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerMonth whereYear($value)
 */
	class StatisticPerMonth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatisticPerYear
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
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereAdjectiveRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereClassifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereEmotions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereImportantWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereNounRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereSpecialPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereStatisticProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereWordCounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatisticPerYear whereYear($value)
 */
	class StatisticPerYear extends \Eloquent {}
}

namespace App\Models{
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
 * @property int|null $user_rank_id ユーザーランク
 * @property int|null $user_role_id ユーザーロール(一般、管理者etc)
 * @property int|null $appearance_id ページの見た目
 * @property string|null $user_rank_updated_at ユーザーランクアップデート日
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diary> $diary
 * @property-read int|null $diary_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserRank|null $userRank
 * @property-read \App\Models\UserReadNotification|null $userReadNotification
 * @property-read \App\Models\UserRole|null $userRole
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppearanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
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
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\UserIp
 *
 * @property int $id
 * @property int $user_id ユーザーID
 * @property string $ip ipアドレス
 * @property string $ua ユーザーエージェント
 * @property string $geo タイトル
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereGeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereUa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserIp whereUserId($value)
 */
	class UserIp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserRank
 *
 * @property int $id
 * @property string $name ユーザーランク名
 * @property string|null $description 説明
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRank whereName($value)
 */
	class UserRank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserReadNotification
 *
 * @property int $id
 * @property int $user_id ユーザーID
 * @property int|null $is_showed_update_user_rank ユーザーランクの更新通知フラグ
 * @property int|null $is_showed_update_system_info アップデート情報更新通知フラグ
 * @property int|null $is_showed_service_info お知らせ通知フラグ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereIsShowedServiceInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereIsShowedUpdateSystemInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereIsShowedUpdateUserRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserReadNotification whereUserId($value)
 */
	class UserReadNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property string $name ユーザーロール名
 * @property string|null $description 説明
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 */
	class UserRole extends \Eloquent {}
}

