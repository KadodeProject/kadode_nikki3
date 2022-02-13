<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnPackagesController extends Controller
{
    public function use(Request $request)
    {
        $form = [
            "user_id" => Auth::id(),
            "package_id" => $request->package_id,
        ];

        NlpPackageUser::create($form);
        return redirect('statistics/settings');
    }
    public function release(Request $request)
    {
        NlpPackageUser::where('user_id', Auth::id())->where('package_id', $request->package_id)->delete();
        return redirect('statistics/settings');
    }
}