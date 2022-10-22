<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "description"
    ];

    //バリデーション
    public static $rules = [
        "name" => "required",
    ];

    //時間カラムの自動挿入無効化
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
