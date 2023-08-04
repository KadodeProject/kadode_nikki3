<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Osirase;

use App\OpenApi\Schemas\Osirase\OsiraseResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class OsiraseResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(OsiraseResponseSchema::ref())
            );
    }
}
