<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageUser;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

final class UsePackageAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        $form = [
            "user_id" => Auth::id(),
            "package_id" => $request->package_id,
        ];

        NlpPackageUser::create($form);
        return redirect('statistics/settings');
    }
}
