<?php

declare(strict_types=1);

namespace App\Rules\Diary;

use App\Models\Diary;
use Illuminate\Contracts\Validation\Rule;

class RejectExistDayDiaryForUpdateOnDateRule implements Rule
{
    /** @param array <{user_id: int, diary_id: int}> $attributes */
    protected array $attributes;
    /**
     * 本来1対1のルールに複数情報を渡したいのでコンストラクタを使って対処する
     * ここでAuth:id()するのでなく、newするときにauth:idすることで依存性を注入できるようにする
     *
     */
    public function __construct(int $user_id, int $diary_id)
    {
        $this->attributes = ['user_id' => $user_id, 'diary_id' => $diary_id];
    }
    /**
     * 日記を更新しようとしているユーザーが日付を変えたときに、既に存在している日付なら断る(そうすることで、上書きで過去の日記が消えることを防ぐ)
     * 更新時用のルール(新規と違い自分自身が1つあるので自分自身は除く必要がある)
     * 日付が同じ→更新してOK
     * 日付が違う→他に同日がなければ更新してOK
     *
     * @param string $attributes
     * @param mixed $value
     * @todo 正直ここでAuth呼び出すのは責務分割全然できてないので避けたい。でもこれしか方法なさそう
     */
    public function passes(mixed $attribute, mixed  $value): bool
    {
        return !Diary::where('user_id', $this->attributes['user_id'])->where('date', $value)->where('id', '!=', $this->attributes['diary_id'])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.existSameDayDiary');
    }
}