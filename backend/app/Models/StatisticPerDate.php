<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 日記の統計に使うデータを格納する.
 */
class StatisticPerDate extends Model
{
    /** statisticPerMonthなどはuser_idで紐づいているがこのテーブルは */
    use HasFactory;
    protected $fillable = [
        'statistic_progress', 'emotions', 'classification', 'important_words', 'special_people',
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
        'classification'  => 'json',
        'important_words' => 'json',
        'special_people'  => 'json',
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
}
