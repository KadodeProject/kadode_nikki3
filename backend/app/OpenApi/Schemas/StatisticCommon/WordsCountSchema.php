<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\StatisticCommon;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class WordsCountSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('words_count_schema')
            ->items(Schema::object()
                // 本来はarray->itemsだが、2次元配列的なものがサポートされていないのでobjectで表している
                ->properties(
                    Schema::string('name')->description('単語')->example('サナトリウム'),
                    Schema::integer('count')->example(4),
                ));
    }
}
