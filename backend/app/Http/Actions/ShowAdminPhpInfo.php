<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\UserRank;
use App\Models\UserRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminPhpInfo extends Controller
{
    public function __invoke()
    {
        phpinfo();
    }
}