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

class GetAllOsiraseResponseSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('GetAllOsiraseResponse')
            ->properties(
                Schema::array('osirase')
                    ->items(
                        Schema::object()->properties(
                            Schema::string('id')->example('1'),
                            Schema::string('title')->example('タイトル'),
                            Schema::string('content')->description('改行含む文字列が入ってくるがエスケープなどはされていない')->example('内容'),
                            Schema::string('created_at')->example('2021-01-01 00:00:00'),
                            Schema::string('updated_at')->example('2021-01-01 00:00:00'),
                        )
                    )
            );
    }
}
