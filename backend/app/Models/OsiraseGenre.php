<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsiraseGenre extends Model
{
    use HasFactory;

    // 時間カラムの自動挿入無効化
    public const created_at = null;
    public const updated_at = null;
    protected $fillable = [
        'name',
    ];
}
