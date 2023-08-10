<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\Statistic;

use App\OpenApi\Schemas\StatisticCommon\DateCountSchema;
use App\OpenApi\Schemas\StatisticCommon\EmotionsSchema;
use App\OpenApi\Schemas\StatisticCommon\WordsCountSchema;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class StatisticSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('statistic')
            ->properties(
                Schema::integer('id')->example(1),
                Schema::integer('user_id')->example(1),
                Schema::integer('statistic_progress')->example(100),
                DateCountSchema::ref('month_words')->description('各月の合計文字数'),
                DateCountSchema::ref('month_diaries')->description('各月の合計日記数'),
                DateCountSchema::ref('year_words')->description('各年の合計文字数'),
                DateCountSchema::ref('year_diaries')->description('各年の合計日記数'),
                Schema::integer('total_words')->example(100000)->description('合計文字数'),
                Schema::integer('total_diaries')->example(100)->description('合計日記数'),
                WordsCountSchema::ref('total_noun_asc')->description('名詞の出現回数の多い順 Top50'),
                WordsCountSchema::ref('total_adjective_asc')->description('形容詞の出現回数の多い順 Top50'),
                // diary_grass←これ使われてない
                EmotionsSchema::ref('emotions')->description('感情数値(感情数値化のグラフと平均用)'),
                WordsCountSchema::ref('classifications')->description('推定分類 Top10'),
                WordsCountSchema::ref('special_people')->description('登場人物 Top10'),
                WordsCountSchema::ref('important_words')->description('重要そうな言葉 Top10'),
                Schema::string('created_at')->example('2021-01-01 00:00:00'),
                Schema::string('updated_at')->example('2021-01-01 00:00:00'),
            )->nullable();
    }
}
