<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;

/**
 * 日記の本文をNLPで彩るようの配列に変換するユースケース
 *
 */
class ShapeContentWithNlp
{
    /**
     * @return array<{form:string,xPOSTag:string,color:string}>
     */
    public function invoke(Diary $diary): array
    {
        $wordBox = [];
        $token2Json = json_decode($diary->token);
        foreach ($token2Json as $token) {
            /**
             * @memo uPosTagが世界共通の大別で、xPosがローカルの分類(名詞-固有名詞など)
             */
            switch ($token->uPOSTag) {
                case 'NOUN': //名詞
                    $color = "#ffffff";
                    break;
                case 'VERB': //動詞
                    $color = "#e3e5e8";
                    break;
                default:
                    $color = "#f9fff9";
                    break;
            }
            $wordBox[] = [
                'form' => $token->form,
                'xPOSTag' => $token->xPOSTag,
                'color' => $color,
            ];
        }
        return $wordBox;
    }
}
