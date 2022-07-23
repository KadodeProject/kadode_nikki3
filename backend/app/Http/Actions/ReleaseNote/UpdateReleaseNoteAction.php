<?php

declare(strict_types=1);

namespace App\Http\Actions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateReleaseNoteAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, Releasenote::$rules);

        $updateContent = [
            "title" => $request->title,
            "genre_id" => $request->releasenote_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Releasenote::where('id', $request->releasenote_id)->update($updateContent);
        return redirect(route('ShowAdminNotification') . '#releaseNote');
    }
}
