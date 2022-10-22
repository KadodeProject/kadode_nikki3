<?php

declare(strict_types=1);

namespace App\Http\Actions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeleteReleaseNoteAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        Releasenote::where('id', $request->releasenote_id)->delete();

        return redirect(route('ShowAdminNotification').'#releaseNote');
    }
}
