<?php

declare(strict_types=1);

namespace App\Http\Actions\CustomNER;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\CustomNER;

class DeleteCNERAction extends Controller
{
    public function __invoke(Request $request):Redirector|RedirectResponse
    {
        CustomNER::where('id', $request->customNER_id)->delete();
        return redirect('statistics/settings#customNERTable');
    }
}
