<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Diary;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class CreateDiaryActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(
                    Schema::object('status')
                        ->properties(
                            Schema::string('result')->example('success'),
                        )
                )
            );
    }
}
