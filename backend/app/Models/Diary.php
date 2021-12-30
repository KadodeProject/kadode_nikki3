<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeDiary;

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
        static::addGlobalScope(new ScopeDiary);
    }


    /**
     * Undocumented variable
     *
     * @var array
     * string型は255バイト？文字？
     * integerは11桁まで
     * unsignedBigIntegerはlaravelのid標準
     * textタイプはmax 65,535バイトでマルチバイトなので大目に見て20000字
     * longTextというmax4,294,967,295バイトまで行けるものもある。
     *
     * numericが整数値のバリデーション
     * user_idは後で入れるので不要
     *
     */
    public static $rules=array(
        "date"=>"required",
        "title"=>"max:50",//laravelのstringはvarchar(255)なので、255文字まで、しかし入らないから50字に抑える
        "content"=>"required|min:1|max:16000",//text型の限界が16384文字なので(マルチバイトで)
        // "user_id"=>"required|numeric",
        );

    protected $fillable = [
            "statistic_progress","user_id","uuid","title","content","date" ,"sentence","chunk","token","affiliation","meta_info","similar_sentences","char_length","emotions","flavor","classification","important_words","cause_effect_sentences","special_people","updated_statistic_at","created_at","updated_at"
    ];

     // 初期値設定(statistic_progressを0にする)
    protected $attributes = [
        "statistic_progress" =>0,
    ];

    //日付設定
    protected $dates = ['user_rank_updated_at'];
}