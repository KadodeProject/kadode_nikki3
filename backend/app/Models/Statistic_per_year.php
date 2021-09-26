<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic_per_year extends Model
{
    use HasFactory;
    protected $fillable = [
        "statistic_progress","user_id","year","emotions","noun_rank","adjective_rank","important_words","special_people","classifications","created_at","updated_at"
    ];
     // 初期値設定(statistic_progressを0にする)
     protected $attributes = [
        "statistic_progress" =>0,
    ];
}