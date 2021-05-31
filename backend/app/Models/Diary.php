<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    public static $rules=array(
        "date"=>"required",
        "title"=>"max:50",
        "content"=>"min:1",
        "user_id"=>"integer",
        );
    protected $fillable = [
            "user_id","content","title","date" ,"feel","uuid"
        ];
}