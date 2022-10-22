<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Osirase extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", "genre_id", "description", "date", "created_at", "updated_at"
    ];

    //format(年月日)するために
    protected $dates = ['date'];

    //バリデーション
    public static $rules = [
        "date" => "required",
        "title" => "required|max:50",
        "description" => "required",
    ];

    public function osiraseGenre(): BelongsTo
    {
        return $this->belongsTo(OsiraseGenre::class, 'genre_id', 'id');
    }
}
