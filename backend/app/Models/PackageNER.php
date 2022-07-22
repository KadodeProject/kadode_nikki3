<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageNER extends Model
{
    //グローバールスコープ不要！！
    use HasFactory;
    protected $fillable = [
        "package_id", "label_id", "name", "created_at", "updated_at"
    ];

    //バリデーション
    public static $rules = array(
        "name" => "required|max:50",
        "label_id" => "min:0|integer",
    );
}