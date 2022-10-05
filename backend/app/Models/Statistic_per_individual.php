<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 日記の統計に使うデータを格納する
 */
class Statistic_per_individual extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser);
    }
    use HasFactory;
    protected $fillable = [
        "statistic_progress", "emotions", "classification", "important_words", "special_people",
    ];
    /**
     * 日付の登録(format使えるように)
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}