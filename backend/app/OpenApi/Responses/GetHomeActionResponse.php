<?php

declare(strict_types=1);

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\Diary\DiaryResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetHomeActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('成功レスポンス')
            ->content(
                MediaType::json()->schema(
                    Schema::object('return')
                        ->properties(
                            Schema::array('unreadNotifications')->items(
                                Schema::object('unreadNotifications')->properties(
                                    Schema::string('url')->example('/osirase'),
                                    Schema::string('actionUrl')->example('http://backend:2010/notification/osirase/remove'),
                                    Schema::string('bg_color')->example('51, 118, 156'),
                                    Schema::string('title')->example('xxについて'),
                                    Schema::string('date')->example('2021-12-29T15:00:00.000000Z'),
                                ),
                            ),
                            Schema::array('oldDiaries')->items(
                                DiaryResponseSchema::ref('oldDiary')
                            ),
                            DiaryResponseSchema::ref('zeroDayAgoDiary'),
                            DiaryResponseSchema::ref('oneDayAgoDiary'),
                            DiaryResponseSchema::ref('twoDayAgoDiary'),
                            DiaryResponseSchema::ref('threeDayAgoDiary'),
                            Schema::array('latestDiaries')->items(
                                DiaryResponseSchema::ref('latestDiary'),
                            ),
                        )
                )
            );
    }
}
