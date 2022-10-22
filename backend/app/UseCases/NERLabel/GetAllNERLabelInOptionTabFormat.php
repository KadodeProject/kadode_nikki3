<?php

declare(strict_types=1);

namespace App\UseCases\NERLabel;

/**
 * Undocumented class.
 */
final class GetAllNERLabelInOptionTabFormat
{
    /**
     * @phpstan-param array<array{id:int,name:string}> $NERLabels
     */
    public function invoke(array $NERLabels): string
    {
        /** @var string */
        $NERLabelsInOptionTabFormat = '';

        foreach ($NERLabels as $NERLabel) {
            $NERLabelsInOptionTabFormat = $NERLabelsInOptionTabFormat.' <option value="'.$NERLabel['id'].'">'.$NERLabel['name'].'</option>';
        }

        return $NERLabelsInOptionTabFormat;
    }
}
