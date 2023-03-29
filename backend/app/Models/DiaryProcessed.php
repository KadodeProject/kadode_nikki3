<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 日記の統計に使う自然言語処理データを格納する.
 */
class DiaryProcessed extends Model
{
    use HasFactory;
    protected $fillable = [
        'sentence', 'chunk', 'token', 'affiliation', 'char_length',
    ];

    /**
     * 日付の登録(format使えるように).
     *
     * @var array<string,string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
