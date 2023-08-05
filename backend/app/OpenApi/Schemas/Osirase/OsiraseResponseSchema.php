<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\Osirase;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class OsiraseResponseSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('osirase')
            ->items(
                Schema::object('osirase')
                    ->properties(
                        Schema::string('title')->example('タイトル'),
                        Schema::string('date')->example('2021-12-29T15:00:00.000000Z'),
                        Schema::string('description')->description('改行含む文字列が入ってくるがエスケープなどはされていない')->example('内容'),
                        Schema::string('url')->example('http://localhost:2010/osirase'),
                    )
            );
    }
}
