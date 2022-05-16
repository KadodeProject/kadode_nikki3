<?php

declare(strict_types=1);

namespace App\UseCases\NERLabel;

use App\Models\NERLabel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Undocumented class
 */
final class GetAllNERLabelInOptionTabFormat
{
    public function invoke(): string
    {
        /** @property Collection */
        $NERLabels = NERLabel::all();

        /** @property string */
        $NERLabelsInOptionTabFormat = "";

        foreach ($NERLabels as $NERLabel) {
            $NERLabelsInOptionTabFormat = $NERLabelsInOptionTabFormat . " <option value='" . $NERLabel->id . "'>" . $NERLabel->name . "</option>";
        }

        return $NERLabelsInOptionTabFormat;
    }
}