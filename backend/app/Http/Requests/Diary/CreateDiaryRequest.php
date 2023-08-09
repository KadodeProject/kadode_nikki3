<?php

declare(strict_types=1);

namespace App\Http\Requests\Diary;

use App\Rules\Diary\RejectExistDayDiaryForCreateOnDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // アプリケーションの別の部分でリクエストの認可ロジックを処理しているため、ここは強制true
        // https://readouble.com/laravel/9.x/ja/validation.html
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *            string型は255バイト？文字？
     *            integerは11桁まで
     *            unsignedBigIntegerはlaravelのid標準
     *            textタイプはmax 65,535バイトでマルチバイトなので大目に見て20000字
     *            longTextというmax4,294,967,295バイトまで行けるものもある。
     *
     * numericが整数値のバリデーション
     * user_idは後で入れるので不要
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = Auth::id();
        assert(is_int($id));

        return [
            'date'    => ['required', new RejectExistDayDiaryForCreateOnDateRule($id)],
            'title'   => ['max:50'], // laravelのstringはvarchar(255)なので、255文字まで、しかし入らないから50字に抑える
            'content' => ['required', 'min:1', 'max:16000'], // text型の限界が16384文字なので(マルチバイトで)
        ];
    }
}
