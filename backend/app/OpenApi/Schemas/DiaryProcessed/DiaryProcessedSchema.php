<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\DiaryProcessed;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class DiaryProcessedSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('diary_processed')
            ->properties(
                Schema::integer('id')->example(1),
                Schema::integer('diary_id')->example(1),
                Schema::integer('statistic_progress')->example(100),
                SentenceSchema::ref('sentence'),
                ChunkSchema::ref('chunk'),
                TokenSchema::ref('token'),
                AffiliationSchema::ref('affiliation'),
                Schema::integer('char_length')->example(200),
                Schema::string('created_at')->example('2023-08-05T04:36:55.000000Z'),
                Schema::string('updated_at')->example('2023-08-05T04:36:55.000000Z'),
            )->nullable();
    }
}
