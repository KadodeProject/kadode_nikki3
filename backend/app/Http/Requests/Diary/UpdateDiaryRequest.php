<?php

declare(strict_types=1);

namespace App\Http\Requests\Diary;

use App\Rules\Diary\RejectExistDayDiaryForUpdateOnDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

/**
 * Createでは既存の日付判定が必要だが、updateではそれが不要なのでCreateとは別で必要
 */
class UpdateDiaryRequest extends FormRequest
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
     * @deprecated
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id'      => ['required', 'integer'], // 日記重複日付比較のために必要
            'title'   => ['max:50'], // laravelのstringはvarchar(255)なので、255文字までだが、マルチバイトなど色々踏まえて50に押
            'content' => ['required', 'min:1', 'max:16000'], // text型の限界が16384文字なので(マルチバイトで)
            /*
             * 結構豪快な方法でid引っ張ってきてて良くない(バリデーションを通さない値が取れてしまうため)
             *
             * strict_type=1で指定しているため、明示的にintにキャストが必要
             * たとえば'2aaa'も2になり、これは意図しない値ですが、この先のRuleで処理しているメソッド内部で呼ぶeloquentでユーザー絞った後にid検索のため、不正な値はヒットせず問題なし
             * eloquent側もSQLインジェクション対策は施されているため、結果としてこの処理は安全です。
             * $this->request->idだと取れない
             */
            'date'    => ['required', new RejectExistDayDiaryForUpdateOnDateRule(Auth::id(), $this->request->all()['id'])],
        ];
    }
}
