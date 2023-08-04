<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\User;

use App\OpenApi\Schemas\User\GetUserInfoActionResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetUserInfoActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(GetUserInfoActionResponseSchema::ref())
            );
    }
}
