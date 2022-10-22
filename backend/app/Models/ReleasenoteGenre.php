<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleasenoteGenre extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    //時間カラムの自動挿入無効化
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
