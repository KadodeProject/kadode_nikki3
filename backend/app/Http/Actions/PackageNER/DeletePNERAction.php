<?php

declare(strict_types=1);

namespace App\Http\Actions\PackageNER;

use App\Http\Controllers\Controller;
use App\Models\PackageNER;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeletePNERAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        PackageNER::where('id', $request->PackageNER_id)->delete();

        return redirect(route('ShowAdminIndividualPackage', ['packageId' => $request->packageId]));
    }
}
