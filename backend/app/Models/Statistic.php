<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser);
    }

    use HasFactory;


    protected $fillable = [
        "statistic_progress", "user_id", "total_words", "total_diaries", "month_words", "month_diaries", "year_words", "year_diaries", "total_noun_asc", "year_noun_asc", "month_noun_asc", "total_adjective_asc", "year_adjective_asc", "month_adjective_asc", "diary_grass", "emotions", "classifications", "special_people", "created_at", "updated_at"
    ];
    // 初期値設定(statistic_progressを0にする)
    protected $attributes = [
        "statistic_progress" => 0,
    ];
}
