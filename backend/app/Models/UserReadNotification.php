<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReadNotification extends Model
{
    use HasFactory;

    // 初期値設定
    protected $attributes = [
        'is_showed_update_user_rank' => 0,
        'is_showed_update_system_info' => 0,
        'is_showed_service_info' => 0,
    ];

    protected $fillable = [
        'user_id',
        'is_showed_update_user_rank',
        'is_showed_update_system_info',
        'is_showed_service_info',
    ];
}
