<?php

declare(strict_types=1);

namespace App\Http\Actions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeleteOsiraseAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        Osirase::where('id', $request->osirase_id)->delete();
        return redirect(route('ShowAdminNotification') . '#osirase');
    }
}
