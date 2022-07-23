<?php

declare(strict_types=1);

namespace App\Http\Actions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateOsiraseAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, Osirase::$rules);

        $updateContent = [
            "title" => $request->title,
            "genre_id" => $request->osirase_genre_id,
            "description" => $request->description,
            "date" => $request->date,
        ];

        Osirase::where('id', $request->osirase_id)->update($updateContent);
        return redirect(route('ShowAdminNotification') . '#osirase');
    }
}
