<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'rank', 'kinds', 'is_morphological', 'is_synonym', 'is_kana', 'created_at', 'updated_at',
    ];

    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
