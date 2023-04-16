<?php

declare(strict_types=1);

namespace App\Services\Grpc;

use Grpc\ChannelCredentials;
use GrpcClient\Nlp\GenerateAllRequest;
use GrpcClient\Nlp\NlpManagerClient;

class GrpcGetter
{
    public function getGrpcRequest(int $userId): bool
    {
        $client = new NlpManagerClient(
            config('grpc.server_url'),
            [
                'credentials' => ChannelCredentials::createInsecure(),
            ]
        );
        $grpcRequest = new GenerateAllRequest();
        $grpcRequest->setUserId($userId);
        [$response, $status] = $client->GenerateAll($grpcRequest)->wait();

        return $response->start;
    }
}
