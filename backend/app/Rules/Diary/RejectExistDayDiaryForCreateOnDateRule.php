<?php

declare(strict_types=1);

namespace App\Rules\Diary;

use App\Models\Diary;
use Illuminate\Contracts\Validation\Rule;

class RejectExistDayDiaryForCreateOnDateRule implements Rule
{
    /** @param array <array{user_id: int}> $attributes */
    protected array $attributes;

    /**
     * 本来1対1のルールに複数情報を渡したいのでコンストラクタを使って対処する
     * ここでAuth:id()するのでなく、newするときにauth:idすることで依存性を注入できるようにする.
     */
    public function __construct(int $user_id)
    {
        $this->attributes = ['user_id' => $user_id];
    }

    /**
     * 日記を新しく保存しようとしているユーザーが既に同じ日の日記を持っていたら断る
     * 新規で保存する時用のルール、更新で使うと当たり前だが既に同日の日記になるので怒られる
     * 更新時はRejectExistDayDiaryRuleを使う.
     */
    public function passes(mixed $attribute, mixed $value): bool
    {
        return !Diary::where('user_id', $this->attributes['user_id'])->where('date', $value)->exists();
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return trans('validation.existSameDayDiary');
    }
}
