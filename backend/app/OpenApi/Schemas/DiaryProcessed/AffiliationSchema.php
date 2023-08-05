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

class AffiliationSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('affiliation')->items(
            Schema::object('affiliation')->description('固有表現抽出')
                ->properties(
                    Schema::integer('start')->description('単語開始位置')->example(642),
                    Schema::integer('end')->description('単語終了位置')->example(641),
                    Schema::string('lemma')->description('単語の原型')->example('朝'),
                    Schema::string('form')->description('分類(関根の拡張固有表現階層 ver7.1.2ベース)')->example('Time'),
                )
        );
    }
}
