<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic_overall_progress extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","progress_chr","progress_percent"
    ];
}