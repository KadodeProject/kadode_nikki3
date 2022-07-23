<?php

declare(strict_types=1);

namespace App\Http\Actions\User\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use function redirect;

final class RemoveOsiraseNoticeAction extends Controller
{
    public function __invoke(): Redirector|RedirectResponse
    {
        User::where('id', Auth::id())->update(["is_showed_service_info" => 1]);
        return redirect(route('ShowHome'));
    }
}
