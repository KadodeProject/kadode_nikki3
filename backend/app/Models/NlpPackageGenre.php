<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NlpPackageGenre extends Model
{
    // グローバールスコープ不要！！

    use HasFactory;

    // バリデーション
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
    protected $fillable = [
        'name', 'description', 'created_at', 'updated_at',
    ];
}
