<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\CreateDiaryRequest;
use App\Models\Diary;
use App\OpenApi\RequestBodies\Diary\CreateDiaryRequestBody;
use App\OpenApi\Responses\OkResponse;
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
    #[OpenApi\RequestBody(CreateDiaryRequestBody::class)]
    #[OpenApi\Response(OkResponse::class)]
    public function __invoke(CreateDiaryRequest $request): void
    {
        $diary = [
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
            'date'    => $request->date,
            'uuid'    => Str::uuid(),
        ];

        Diary::create($diary);
        // ここで統計用テーブル作成するのもありだが、後方互換を保つためにはできないたいめ、生成時になかったら作る方式を採用している
    }
}
