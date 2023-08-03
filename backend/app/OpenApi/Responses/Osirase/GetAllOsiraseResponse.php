<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Osirase;

use App\OpenApi\Schemas\Osirase\GetAllOsiraseResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetAllOsiraseResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(GetAllOsiraseResponseSchema::ref())
            );
    }
}
