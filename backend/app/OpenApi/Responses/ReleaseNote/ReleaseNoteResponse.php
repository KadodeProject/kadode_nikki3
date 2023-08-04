<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\ReleaseNote;

use App\OpenApi\Schemas\ReleaseNote\ReleaseNoteResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ReleaseNoteResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(ReleaseNoteResponseSchema::ref())
            );
    }
}
