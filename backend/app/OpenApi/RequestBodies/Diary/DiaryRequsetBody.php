<?php

declare(strict_types=1);

namespace App\OpenApi\RequestBodies\Diary;

use App\OpenApi\Schemas\Diary\DiaryRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class DiaryRequsetBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(
            MediaType::json()->schema(
                DiaryRequestBodySchema::ref()
            )
        );
    }
}
