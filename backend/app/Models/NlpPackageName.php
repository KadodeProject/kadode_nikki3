<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NlpPackageName extends Model
{
    use HasFactory;

    // バリデーション
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
    protected $fillable = [
        'name', 'user_id', 'is_publish', 'genre_id', 'description', 'created_at', 'updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
