<?php

declare(strict_types=1);

namespace App\Http\Actions\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

final class DeleteUserAction extends Controller
{
    public function __invoke(): Redirector|RedirectResponse
    {
        User::destroy(Auth::id());
        return redirect("/");
    }
}