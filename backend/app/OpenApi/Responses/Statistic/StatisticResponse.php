<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Statistic;

use App\OpenApi\Schemas\Statistic\StatisticSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class StatisticResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(StatisticSchema::ref())
            );
    }
}
