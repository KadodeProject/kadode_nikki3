<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * 明示しなくてもログイン中のユーザーのみの日記を絞り込むグローバルスコープ
 */
class ScopeDiary implements Scope{
    public function apply(Builder $builder,Model $model){
        $builder->where("user_id",Auth::id());
    }
}