<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\OAuth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Link;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class HandleProviderCallbackActionResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::create()
            ->statusCode(302)
            ->description('ホームリダイレクト')
            ->links(Link::create()
                ->operationId('Redirect to home'));
        // ↓を指定すると生成時に検証が走ってスクリプトが落ちるのでコメントアウト
        // ->ref('http://localhost:2000/home'));
    }
}
