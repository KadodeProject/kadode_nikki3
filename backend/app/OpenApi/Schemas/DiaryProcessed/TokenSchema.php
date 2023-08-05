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

class TokenSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::array('token')->items(Schema::object('token')->description('形態素分析された中身')
            ->properties(
                Schema::integer('start')->description('単語開始位置')->example(61),
                Schema::integer('end')->description('単語終了位置')->example(65),
                Schema::string('form')->description('単語本体')->example('しゃがん'),
                Schema::string('lemma')->description('単語の原型')->example('しゃがむ'),
                Schema::string('uPOSTag')->description('Universal Part-Of-Speech Tag/自然言語共通のタグ')->example('PROPN'),
                Schema::string('xPOSTag')->description('Language-Specific Part-Of-Speech Tag/日本語の品詞')->example('動詞-一般'),
                Schema::boolean('isUnknown')->description('未知判定')->example(true),
            ));
    }
}
