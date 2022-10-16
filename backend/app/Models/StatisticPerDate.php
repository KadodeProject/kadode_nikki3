<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 日記の統計に使うデータを格納する
 */
class StatisticPerDate extends Model
{
    /** statisticPerMonthなどはuser_idで紐づいているがこのテーブルは */
    use HasFactory;
    protected $fillable = [
        "statistic_progress", "emotions", "classification", "important_words", "special_people",
    ];
    protected $casts = [
        'created_at'        => 'datetime:Y-m-d H:i:s',
        'updated_at'        => 'datetime:Y-m-d H:i:s',  
    ];
    /**
     * 日付の登録(format使えるように)
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
