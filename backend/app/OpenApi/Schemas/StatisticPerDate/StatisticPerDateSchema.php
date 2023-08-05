<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\StatisticPerDate;

use App\OpenApi\Schemas\StatisticCommon\ImportantWordsSchema;
use App\OpenApi\Schemas\StatisticCommon\SpecialPeopleSchema;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class StatisticPerDateSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('statistic_per_date')
            ->properties(
                Schema::integer('id')->example(1),
                Schema::integer('diary_id')->example(1),
                Schema::integer('statistic_progress')->example(100),
                Schema::number('emotions')->example(0.16129032258064516),
                Schema::string('classification')->example('人物'),
                ImportantWordsSchema::ref('important_words'),
                SpecialPeopleSchema::ref('special_people'),
                Schema::string('created_at')->example('2021-01-01 00:00:00'),
                Schema::string('updated_at')->example('2021-01-01 00:00:00'),
            )->nullable();
    }
}
