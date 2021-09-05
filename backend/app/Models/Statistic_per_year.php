<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic_per_year extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","year","ave_emotions","noun_rank","adjective_rank","important_words","special_people","classifications","created_at","updated_at"
    ];
}