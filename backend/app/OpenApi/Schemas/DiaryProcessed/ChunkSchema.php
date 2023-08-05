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

class ChunkSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('chunk')->items(
            Schema::object('chunk')->description('係り受け構造')
                ->properties(
                    Schema::string('dependencyTag')->description('形態論情報')->example('advmod'),
                    Schema::string('dependencyTxt')->description('該当単語')->example('じっと'),
                    Schema::integer('dependencyForId')->description('係り先')->example(37),
                    Schema::string('dependencyForTxt')->description('係り先の単語')->example('隠れ'),
                )
        );
    }
}
