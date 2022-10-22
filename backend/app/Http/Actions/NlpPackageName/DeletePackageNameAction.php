<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageName;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageName;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeletePackageNameAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        NlpPackageName::where('id', $request->NlpPackageName_id)->delete();

        return redirect(route('ShowAdminPackage'));
    }
}
