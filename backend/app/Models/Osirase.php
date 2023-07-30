<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Osirase extends Model
{
    use HasFactory;

    // バリデーション
    public static $rules = [
        'date'        => 'required',
        'title'       => 'required|max:50',
        'description' => 'required',
    ];
    protected $fillable = [
        'title', 'genre_id', 'description', 'date', 'created_at', 'updated_at',
    ];

    /**
     * 日付の登録(format使えるように).
     *
     * @var array<string,string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function osiraseGenre(): BelongsTo
    {
        return $this->belongsTo(OsiraseGenre::class, 'genre_id', 'id');
    }
}
