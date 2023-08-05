<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\CreateDiaryRequest;
use App\Models\Diary;
use App\OpenApi\RequestBodies\Diary\CreateDiaryActionRequsetBody;
use App\OpenApi\Responses\Diary\CreateDiaryActionResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class CreateDiaryAction extends Controller
{
    /**
     * 日記を作成する
     */
    #[OpenApi\Operation()]
    #[OpenApi\RequestBody(CreateDiaryActionRequsetBody::class)]
    #[OpenApi\Response(CreateDiaryActionResponse::class)]
    public function __invoke(CreateDiaryRequest $request): JsonResponse
    {
        $request->date ??= Carbon::today()->format('y-m-d');

        $form = [
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
            'date'    => $request->date,
            'uuid'    => Str::uuid(),
        ];

        Diary::create($form);
        // ここで統計用テーブル作成するのもありだが、後方互換を保つためにはできないたいめ、生成時になかったら作る方式を採用している
        return response()->json(
            [
                'result' => 'success',
            ]
        );
    }
}
