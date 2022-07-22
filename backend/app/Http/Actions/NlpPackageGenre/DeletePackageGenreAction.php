<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageGenre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use App\Models\NlpPackageGenre;

final class DeletePackageGenreAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        NlpPackageGenre::where('id', $request->NlpPackageGenre_id)->delete();
        return redirect('administrator/package#packageGenreTable');
    }
}
