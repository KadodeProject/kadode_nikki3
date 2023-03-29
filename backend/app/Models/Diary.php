<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\ScopeLoggedInUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Diary extends Model
{
    /**
     * Undocumented variable.
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
     */
    public static $rules = [
        'date' => 'required',
        'title' => 'max:50', // laravelのstringはvarchar(255)なので、255文字まで、しかし入らないから50字に抑える
        'content' => 'required|min:1|max:16000', // text型の限界が16384文字なので(マルチバイトで)
        // "user_id"=>"required|numeric",
    ];

    protected $fillable = [
        'user_id', 'uuid', 'title', 'content', 'date', 'created_at', 'updated_at',
    ];

    /**
     * 日付の登録(format使えるように).
     *
     * @var array<string,string>
     */
    protected $casts = [
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function statisticPerDate(): HasOne
    {
        return $this->hasOne(StatisticPerDate::class);
    }

    public function diaryProcessed(): HasOne
    {
        return $this->hasOne(DiaryProcessed::class);
    }

    /**
     * $castsではtoArray,toJsonでUTCになってしまうため、アクセサで上書きする.
     */
    public function date(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d'),
        );
    }

    /**
     * $castsではtoArray,toJsonでUTCになってしまうため、アクセサで上書きする.
     */
    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
        );
    }

    /**
     * $castsではtoArray,toJsonでUTCになってしまうため、アクセサで上書きする.
     */
    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d H:i:s'),
        );
    }

    /**
     * 日記を自動でログインユーザーのみに絞り込むグローバルスコープの呼び出し関数.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ScopeLoggedInUser());
    }
}
