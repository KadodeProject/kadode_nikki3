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
     * JSON系は文字列になるのでJSONに明示的に指定
     *
     * @var array<string,string>
     */
    protected $casts = [
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'sentence'    => 'json',
        'chunk'       => 'json',
        'token'       => 'json',
        'affiliation' => 'json',
    ];
}
