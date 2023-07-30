<?php

declare(strict_types=1);

namespace App\Enums;

enum AuthType: int
{
    case email = 1;

    case google = 2;

    case github = 3;

    public function label(): string
    {
        return match ($this) {
            self::email  => 'メール認証',
            self::google => 'Google認証',
            self::github => 'GitHub認証',
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::email  => 1,
            self::google => 2,
            self::github => 3,
        };
    }
}
