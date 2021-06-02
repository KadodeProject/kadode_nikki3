<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
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
        "title"=>"max:50",
        "feel"=>"required|integer|min:0|max:10",
        "content"=>"required|min:1|max:20000",
        // "user_id"=>"required|numeric",
        );
    
    protected $fillable = [
            "user_id","content","title","date" ,"feel","uuid"
        ];
}