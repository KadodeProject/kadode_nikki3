<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;

class Diary_people extends Model
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
        "user_id", "name", "created_at", "updated_at"
    ];
}