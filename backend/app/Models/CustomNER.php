<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNER extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
    protected $fillable = [
        "user_id", "label_id", "name", "created_at", "updated_at"
    ];

    public static $rules = [
        "label_id" => "min:0|integer",
        // "label"=>"required|exists:n_e_r_labels,label",
        "name" => "required|max:20",
    ];
}
