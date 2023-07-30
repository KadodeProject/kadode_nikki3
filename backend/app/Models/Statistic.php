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
