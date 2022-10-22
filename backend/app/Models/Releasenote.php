<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Releasenote extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", "genre_id", "description", "date", "created_at", "updated_at"
    ];
    protected $dates = ['date'];

    public static $rules = [
        "date" => "required",
        "title" => "required|max:50",
        "description" => "required",
    ];

    public function releasenoteGenre(): BelongsTo
    {
        return $this->belongsTo(ReleasenoteGenre::class, 'genre_id', 'id');
    }
}