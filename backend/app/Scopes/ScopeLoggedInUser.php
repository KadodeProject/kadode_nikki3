<?php

declare(strict_types=1);

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

/**
 * 明示しなくてもログイン中のユーザーのみの日記を絞り込むグローバルスコープ.
 */
class ScopeLoggedInUser implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('user_id', Auth::id());
    }
}
