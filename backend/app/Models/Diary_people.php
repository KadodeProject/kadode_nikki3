<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary_people extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","name","created_at","updated_at"
    ];
}