<?php

declare(strict_types=1);

namespace App\Http\Actions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class CreateOsiraseAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, Osirase::$rules);

        //中身作成
        $form = [
            "title" => $request->title,
            "genre_id" => $request->osirase_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Osirase::create($form);

        //ユーザー通知のフラグをオンにする
        User::where('id', '!=', 0)->update(["is_showed_service_info" => 0]);

        return redirect(route('ShowAdminNotification') . '#osirase');
    }
}
