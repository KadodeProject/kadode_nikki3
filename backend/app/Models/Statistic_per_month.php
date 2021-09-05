<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic_per_month extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","year","month","ave_emotions","word_counts","noun_rank","adjective_rank","important_words","special_people","classifications","created_at","updated_at"
    ];
}