<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_rank extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "description",
    ];

    //バリデーション
    public static $rules = array(
        "name" => "required",
    );

    //時間カラムの自動挿入無効化
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
}