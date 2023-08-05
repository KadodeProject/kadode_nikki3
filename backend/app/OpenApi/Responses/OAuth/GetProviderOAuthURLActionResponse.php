<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\OAuth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetProviderOAuthURLActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(
                    Schema::object('return')
                        ->properties(
                            Schema::string('redirect_url')->example('http://localhost:2010/hoge'),
                        )
                )
            );
    }
}
