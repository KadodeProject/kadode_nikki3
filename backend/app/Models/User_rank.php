<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_rank extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","description","created_at","updated_at"
    ];

    //バリデーション
    public static $rules=array(
        "name"=>"required",
    );
}