<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNER extends Model
{
    use HasFactory;

    public static $rules = [
        'label_id' => 'min:0|integer',
        // "label"=>"required|exists:n_e_r_labels,label",
        'name'     => 'required|max:20',
    ];
    protected $fillable = [
        'user_id', 'label_id', 'name', 'created_at', 'updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
