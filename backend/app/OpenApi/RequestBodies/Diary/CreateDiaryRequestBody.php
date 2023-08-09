<?php

declare(strict_types=1);

namespace App\OpenApi\RequestBodies\Diary;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class CreateDiaryRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(
            MediaType::json()->schema(
                Schema::object('CreateDiaryRequestBody')
                    ->properties(
                        Schema::string('date')->example('2021-12-29'),
                        Schema::string('title')->nullable()->example('タイトル'),
                        Schema::string('content')->example('本文~~~~~~~~'),
                    )
            )
        );
    }
}
