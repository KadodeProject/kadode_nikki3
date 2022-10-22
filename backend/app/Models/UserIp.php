<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ip', 'ua', 'geo', 'created_at', 'updated_at',
    ];

    // グローバルスコープ
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
