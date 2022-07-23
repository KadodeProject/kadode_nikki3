<?php

declare(strict_types=1);

namespace App\Http\Actions\CustomNER;

use App\Http\Controllers\Controller;
use App\Models\CustomNER;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class DeleteCNERAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        CustomNER::where('id', $request->customNER_id)->delete();
        return redirect(route('ShowStatisticSetting') . '#customNERTable');
    }
}