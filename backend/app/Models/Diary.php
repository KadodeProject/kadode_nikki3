<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Diary extends Model
{

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser);
    }


    /**
     * Undocumented variable
     *
     * @var array
     *            string型は255バイト？文字？
     *            integerは11桁まで
     *            unsignedBigIntegerはlaravelのid標準
     *            textタイプはmax 65,535バイトでマルチバイトなので大目に見て20000字
     *            longTextというmax4,294,967,295バイトまで行けるものもある。
     *
     * numericが整数値のバリデーション
     * user_idは後で入れるので不要
     *
     */
    public static $rules = array(
        "date" => "required",
        "title" => "max:50", //laravelのstringはvarchar(255)なので、255文字まで、しかし入らないから50字に抑える
        "content" => "required|min:1|max:16000", //text型の限界が16384文字なので(マルチバイトで)
        // "user_id"=>"required|numeric",
    );

    protected $fillable = [
        "user_id", "uuid", "title", "content", "date", "created_at", "updated_at"
    ];

    /**
     * 日付の登録(format使えるように)
     *
     * @var array
     */
    protected $dates = ['date', 'created_at', 'updated_at'];

    public function statisticPerDate(): HasOne
    {
        return $this->hasOne(StatisticPerDate::class, 'diary_id', 'id');
    }
    public function diaryProcessed(): HasOne
    {
        return $this->hasOne(DiaryProcessed::class, 'diary_id');
    }
}