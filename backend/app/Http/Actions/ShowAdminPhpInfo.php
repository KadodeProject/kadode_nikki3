<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;

final class ShowAdminPhpInfo extends Controller
{
    public function __invoke(): void
    {
        phpinfo();
    }
}
