<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","rank","kinds","is_morphological","is_synonym","is_kana","created_at","updated_at"
    ];
}