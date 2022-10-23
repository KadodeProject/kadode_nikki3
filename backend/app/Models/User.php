<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public static $updatePassWordRules = [
        'password' => 'required|min:8|max:100',
    ];
    public static $updateEmailRules = [
        'email' => 'required|email|unique:users,email',
    ];
    public static $updateUserNameRules = [
        'name' => 'required',
    ];
    // 初期値設定
    protected $attributes = [
        'user_rank_id' => 1,
        'user_role_id' => 1,
        'appearance_id' => 1,
        'user_rank_updated_at' => '2021-12-28',
    ];

    // public function diaries(){
    //     return $this->hasMany(Diary::class);
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_rank_id',
        'user_role_id',
        'appearance_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'sentence' => 'json',
        'chunk' => 'json',
        'token' => 'json',
        'affiliation' => 'json',
        'meta_info' => 'json',
        'emotions' => 'json',
        'flavor' => 'json',
        'similar_sentences' => 'json',
        'important_words' => 'json',
        'cause_effect_sentences' => 'json',
        'special_people' => 'json',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // format(年月日)するために
    protected $dates = ['user_rank_updated_at'];

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
    // email_verified_atをキャストするとemailの認証が吹っ飛ぶのでpublic function emailVerifiedAt(): Attributeはしちゃダメ

    public function diary()
    {
        return $this->hasMany(Diary::class);
    }

    public function userRank()
    {
        return $this->belongsTo(UserRank::class);
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function userReadNotification(): HasOne
    {
        return $this->hasOne(UserReadNotification::class, 'diary_id', 'id');
    }
}
