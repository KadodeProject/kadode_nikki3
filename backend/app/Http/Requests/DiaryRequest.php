<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
    public function rules()
    {
        return [
            "date" => "required",
            "title" => "max:50", //laravelのstringはvarchar(255)なので、255文字まで、しかし入らないから50字に抑える
            "content" => "required|min:1|max:16000", //text型の限界が16384文字なので(マルチバイトで)
        ];
    }
}