<?php

declare(strict_types=1);

namespace App\Http\Requests\Diary;

use App\Rules\Diary\RejectExistDayDiaryForUpdateOnDateRule;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        //アプリケーションの別の部分でリクエストの認可ロジックを処理しているため、ここは強制true
        //https://readouble.com/laravel/9.x/ja/validation.html
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
        return [
            'title' => ['max:50'], //laravelのstringはvarchar(255)なので、255文字までだが、マルチバイトなど色々踏まえて50に押
            'content' => ['required', 'min:1', 'max:16000'], //text型の限界が16384文字なので(マルチバイトで)
            'id' => ['required', 'int'],
            /**
             * 結構豪快な方法でid引っ張ってきてて良くない(バリデーションを通さない値が取れてしまうため)
             *
             * 正しい意味でのintキャストをしています(そもそも$this->request->all()で来る値が全部string型なのがよくない……)
             * strict_type=1で指定しているため、明示的にintにキャストが必要
             * たとえば'2aaa'も2になり、これは意図しない値ですが、この先のRuleで処理しているメソッド内部で呼ぶeloquentでユーザー絞った後にid検索のため、不正な値はヒットせず問題なし
             * eloquent側もSQLインジェクション対策は施されているため、結果としてこの処理は安全です。
             */
            'date' => ['required', new RejectExistDayDiaryForUpdateOnDateRule(Auth::id(), (int)$this->request->all()['id'])],
        ];
    }
}