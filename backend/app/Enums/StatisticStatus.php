<?php

declare(strict_types=1);

namespace App\Enums;

// 日記が存在しない、存在するが処理中、存在するが古い、存在して最新の4パターン存在

enum StatisticStatus: int
{
    case existCorrectly = 1;

    case notExist = 2;

    case generating = 3;

    case outdated = 4;

    public function label(): string
    {
        return match ($this) {
            self::existCorrectly => '正しく統計データが存在する',
            self::notExist       => '統計データが存在しない',
            self::generating     => '統計データが生成中',
            self::outdated       => '統計データは存在するが古い(統計データの生成後に日記が更新されたが統計データが更新されていない状況)',
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::existCorrectly => 1,
            self::notExist       => 2,
            self::generating     => 3,
            self::outdated       => 4,
        };
    }
}
