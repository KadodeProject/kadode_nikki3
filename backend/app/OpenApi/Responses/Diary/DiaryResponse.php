<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Diary;

use App\OpenApi\Schemas\Diary\DiaryResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class DiaryResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(DiaryResponseSchema::ref())
            );
    }
}
