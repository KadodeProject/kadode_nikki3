<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\Osirase;
use App\Models\Releasenote;
use App\Models\User;
use App\Models\UserRank;
use App\Models\UserReadNotification;

class GetUnreadNotifications
{
    /**
     * ホーム画面などで表示する未読のお知らせを入れた配列を取得する.
     *
     * @return array<array{url:string,actionUrl:string,bg_color:string,title:string,date:string}>
     */
    public function invoke(User $user): array
    {
        /**
         * ユーザーのお知らせ取得.
         */
        $new_infos = [];
        $userReadNotification = UserReadNotification::where('user_id', $user->id)->first();
        if (null !== $userReadNotification) {
            if (!$userReadNotification->is_showed_service_info) {
                // お知らせ取得
                $osirase = Osirase::where('id', '!=', 0)->orderBy('date', 'desc')->first(['title', 'date']);
                $new_infos[] = ['url' => '/osirase', 'actionUrl' => route('RemoveOsiraseInfo'), 'bg_color' => '51, 118, 156', 'title' => $osirase->title, 'date' => $osirase->date];
            }
            if (!$userReadNotification->is_showed_update_system_info) {
                // リリースノート取得
                $releasenote = Releasenote::where('id', '!=', 0)->orderBy('date', 'desc')->first(['title', 'date']);
                $new_infos[] = ['url' => '/releaseNote', 'actionUrl' => route('RemoveReleasenoteInfo'), 'bg_color' => '51, 156, 118', 'title' => $releasenote->title, 'date' => $releasenote->date];
            }
            if (!$userReadNotification->is_showed_update_user_rank) {
                // ユーザーランク取得
                $user_rank = UserRank::where('id', $user->user_rank_id)->first(['name']);
                $new_infos[] = ['url' => '/settings', 'actionUrl' => route('RemoveUserRankInfo'), 'bg_color' => '226, 83, 74', 'title' => 'ユーザーランクが「'.$user_rank->name.'」になりました！', 'date' => $user->user_rank_updated_at];
            }
        }

        return $new_infos;
    }
}
