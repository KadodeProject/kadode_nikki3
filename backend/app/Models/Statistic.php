<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'statistic_progress', 'user_id', 'total_words', 'total_diaries', 'month_words', 'month_diaries', 'year_words', 'year_diaries', 'total_noun_asc', 'year_noun_asc', 'month_noun_asc', 'total_adjective_asc', 'year_adjective_asc', 'month_adjective_asc', 'diary_grass', 'emotions', 'classifications', 'special_people', 'created_at', 'updated_at',
    ];
    // 初期値設定(statistic_progressを0にする)
    protected $attributes = [
        'statistic_progress' => 0,
    ];

    /**
     * 日付の登録(format使えるように).
     * JSON系は文字列になるのでJSONに明示的に指定
     *
     * @var array<string,string>
     */
    protected $casts = [
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
        'month_words'         => 'json',
        'month_diaries'       => 'json',
        'year_words'          => 'json',
        'year_diaries'        => 'json',
        'total_noun_asc'      => 'json',
        'year_noun_asc'       => 'json',
        'month_noun_asc'      => 'json',
        'total_adjective_asc' => 'json',
        'year_adjective_asc'  => 'json',
        'month_adjective_asc' => 'json',
        'diary_grass'         => 'json',
        'emotions'            => 'json',
        'classifications'     => 'json',
        'special_people'      => 'json',
    ];

    /**
     * $castsではtoArray,toJsonでUTCになってしまうため、アクセサで上書きする.
     */
    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
        );
    }

    /**
     * $castsではtoArray,toJsonでUTCになってしまうため、アクセサで上書きする.
     */
    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
        );
    }

    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
