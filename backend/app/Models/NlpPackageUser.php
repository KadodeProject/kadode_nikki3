<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NlpPackageUser extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
    protected $fillable = [
        "name", "package_id", "user_id", "created_at", "updated_at"
    ];
}
