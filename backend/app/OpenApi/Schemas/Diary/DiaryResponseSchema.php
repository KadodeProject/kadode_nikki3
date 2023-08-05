<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\Diary;

use App\OpenApi\Schemas\DiaryProcessed\DiaryProcessedSchema;
use App\OpenApi\Schemas\StatisticPerDate\StatisticPerDateSchema;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class DiaryResponseSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('diary')
            ->properties(
                Schema::integer('id')->example(1),
                Schema::string('date')->example('2021-01-01'),
                Schema::string('title')->example('タイトル'),
                Schema::string('contente')->example('本文。'),
                Schema::string('updated_at')->example('2021-01-01 00:00:00'),
                Schema::integer('statisticStatus')->example(2), // Enumで持ってる分析状況(統計無いのか解析中なのかなどの判別用)
                StatisticPerDateSchema::ref('statistic_per_date'),
                DiaryProcessedSchema::ref('diary_processed'),
            );
    }
}
