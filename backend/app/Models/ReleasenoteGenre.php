<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleasenoteGenre extends Model
{
    use HasFactory;

    // 時間カラムの自動挿入無効化
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $fillable = [
        'name',
    ];
}
