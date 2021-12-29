<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Releasenote extends Model
{
    use HasFactory;
    protected $fillable = [
        "title","genre_id","description","date","created_at","updated_at"
    ];
    protected $dates = ['date'];

    public static $rules=array(
        "date"=>"required",
        "title"=>"required|max:50",
        "description"=>"required",
        );
}