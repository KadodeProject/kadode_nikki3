<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;

class PackageNER extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeDiary);
    }
    use HasFactory;
    protected $fillable = [
        "user_id","label","name","created_at","updated_at"
    ];

    public static $rules=array(
        "label"=>"required|",
        "name"=>"required|max:50",
        );
}