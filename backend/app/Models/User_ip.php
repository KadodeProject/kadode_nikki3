<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeDiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_ip extends Model
{
    use HasFactory;

    //グローバルスコープ
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeDiary);
    }

    protected $fillable = [
        "user_id", "ip", "ua", "geo", "created_at", "updated_at"
    ];
}