<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\NERLabel;

use App\UseCases\NERLabel\GetAllNERLabelInOptionTabFormat;
use Tests\TestCase;

class GetAllNERLabelInOptionTabFormatTest extends TestCase
{
    /** @property GetAllNERLabelInOptionTabFormat */
    private $getAllNERLabelInOptionTabFormat;

    /** */
    public function test与えられたコレクションをoptionタグ形式のHTMLとして返す()
    {
        //arrange
        $this->getAllNERLabelInOptionTabFormat = new GetAllNERLabelInOptionTabFormat();

        $array = [
            [
                "id" => 1,
                "label" => "Animation",
                "name" => "アニメタイトル",
                "parent" => "かどで日記独自",
            ],
            [
                "id" => 2,
                "label" => "Library_Framework",
                "name" => "ライブラリ名",
                "parent" => "かどで日記独自",
            ]
        ];
        //act
        $response = $this->getAllNERLabelInOptionTabFormat->invoke($array);
        //assert
        $this->assertMatchesRegularExpression('/((\s<option value=")\d+(">).*?(<\/option>))+/', $response);
    }
}