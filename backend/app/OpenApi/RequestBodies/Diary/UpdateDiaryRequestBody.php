<?php

declare(strict_types=1);

namespace App\OpenApi\RequestBodies\Diary;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateDiaryRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(
            MediaType::json()->schema(
                Schema::object('UpdateDiaryRequestBody')
                    ->properties(
                        Schema::integer('id')->example(1),
                        Schema::string('date')->example('2021-12-29'),
                        Schema::string('title')->nullable()->example('タイトル'),
                        Schema::string('content')->example('本文~~~~~~~~'),
                    )
            )
        );
    }
}
