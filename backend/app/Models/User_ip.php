<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;

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
         "user_id","ip","ua","geo" ,"created_at","updated_at"
     ];
}