<?php

declare(strict_types=1);

namespace App\Http\Actions\User\Notification;

use App\Http\Controllers\Controller;
use App\Models\UserReadNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use function redirect;

final class RemoveReleaseNoteNoticeAction extends Controller
{
    public function __invoke(): Redirector|RedirectResponse
    {
        UserReadNotification::where('user_id', Auth::id())->update(["is_showed_update_system_info" => 1]);
        return redirect(route('ShowHome'));
    }
}
