<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;
class Statistic_per_year extends Model
{
    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeDiary);
    }

    use HasFactory;
    protected $fillable = [
        "statistic_progress","user_id","year","emotions","word_counts","noun_rank","adjective_rank","important_words","special_people","classifications","created_at","updated_at"
    ];
     // 初期値設定(statistic_progressを0にする)
     protected $attributes = [
        "statistic_progress" =>0,
    ];
}