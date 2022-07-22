<?php

declare(strict_types=1);

namespace App\Http\Actions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class CreateReleaseNoteAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, Releasenote::$rules);

        //中身作成
        $form = [
            "title" => $request->title,
            "genre_id" => $request->releasenote_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Releasenote::create($form);

        //ユーザー通知のフラグをオンにする
        User::where('id', '!=', 0)->update(["is_showed_update_system_info" => 0]);

        return redirect('administrator/notification');
    }
}
