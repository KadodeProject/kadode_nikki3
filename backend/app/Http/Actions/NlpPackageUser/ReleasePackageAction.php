<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageUser;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

final class ReleasePackageAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        NlpPackageUser::where('user_id', Auth::id())->where('package_id', $request->package_id)->delete();
        return redirect('statistics/settings');
    }
}
