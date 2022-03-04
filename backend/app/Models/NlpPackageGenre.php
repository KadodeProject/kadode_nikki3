<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NlpPackageGenre extends Model
{
    //グローバールスコープ不要！！

    use HasFactory;
    protected $fillable = [
        "name", "description", "created_at", "updated_at"
    ];

    //バリデーション
    public static $rules = array(
        "name" => "required",
        "description" => "required",
    );
}