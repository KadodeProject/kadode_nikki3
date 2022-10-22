<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetDiariesDateNextToDiaryById;
use App\UseCases\Diary\GetDiaryByUuid;
use App\UseCases\Diary\ShapeContentWithNlp;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ShowSingleDiaryAction extends Controller
{
    public function __construct(
        private ShapeContentWithNlp $shapeContentWithNlp,
        private GetDiaryByUuid $getDiaryByUuid,
        private GetDiariesDateNextToDiaryById $getDiariesDateNextToDiaryById,
    ) {
    }

    public function __invoke($uuid): View|RedirectResponse
    {
        $diary = $this->getDiaryByUuid->invoke($uuid);
        if (null === $diary) {
            // 日記無かったらリダイレクトさせる
            return redirect(route('ShowHome'));
        }
        $dateAndUuidBA = $this->getDiariesDateNextToDiaryById->invoke($diary['date']);

        return view('diary/edit', ['diary' => $diary, 'dateAndUuidBA' => $dateAndUuidBA]);
    }
}
