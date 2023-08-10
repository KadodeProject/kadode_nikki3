<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class StatisticPerYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'statistic_progress', 'user_id', 'year', 'emotions', 'word_counts', 'noun_rank', 'adjective_rank', 'important_words', 'special_people', 'classifications', 'created_at', 'updated_at',
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
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'emotions'        => 'json',
        'word_counts'     => 'json',
        'noun_rank'       => 'json',
        'adjective_rank'  => 'json',
        'important_words' => 'json',
        'special_people'  => 'json',
        'classifications' => 'json',
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
