<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    public static $rules=array(
        "date"=>"required"
        );
    protected $fillable = [
            'content',"title","date" ,"feel"
        ];
}
