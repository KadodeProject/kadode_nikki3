<?php

declare(strict_types=1);

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetApiStatusActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(
                    // 量が少ないので、ここで定義してしまう
                    Schema::object('status')
                        ->properties(
                            Schema::string('status')->example('✌'),
                        )
                )
            );
    }
}
