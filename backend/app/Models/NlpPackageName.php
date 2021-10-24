<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;

class NlpPackageGenre extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeDiary);
    }
    use HasFactory;
    protected $fillable = [
        "name","genre_id","description","created_at","updated_at"
    ];
}