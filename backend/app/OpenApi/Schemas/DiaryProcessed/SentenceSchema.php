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

class SentenceSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('sentence')->items(
            Schema::object('sentence')->description('一文ごとの位置(係り受けで使う)')
                ->properties(
                    Schema::integer('end')->description('終了位置')->example(0),
                    Schema::integer('start')->description('開始位置')->example(18),
                )
        );
    }
}
