<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\NERLabel;

use App\UseCases\NERLabel\GetAllNERLabelInOptionTabFormat;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetAllNERLabelInOptionTabFormatTest extends TestCase
{
    /** @var GetAllNERLabelInOptionTabFormat */
    private $getAllNERLabelInOptionTabFormat;

    public function test与えられたコレクションをoptionタグ形式のHTMLとして返す(): void
    {
        // arrange
        $this->getAllNERLabelInOptionTabFormat = new GetAllNERLabelInOptionTabFormat();

        $array = [
            [
                'id'     => 1,
                'label'  => 'Animation',
                'name'   => 'アニメタイトル',
                'parent' => 'かどで日記独自',
            ],
            [
                'id'     => 2,
                'label'  => 'Library_Framework',
                'name'   => 'ライブラリ名',
                'parent' => 'かどで日記独自',
            ],
        ];
        // act
        $response = $this->getAllNERLabelInOptionTabFormat->invoke($array);
        // assert
        $this->assertMatchesRegularExpression('/((\s<option value=")\d+(">).*?(<\/option>))+/', $response);
    }
}
