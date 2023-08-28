<?php

declare(strict_types=1);

namespace App\Services\Grpc;

use Grpc\ChannelCredentials;
use GrpcClient\Nlp\GenerateAllRequest;
use GrpcClient\Nlp\NlpManagerClient;
use Illuminate\Support\Facades\Log;

class GrpcGetter
{
    public function getGrpcRequest(int $userId): bool
    {
        /** @var string このキャストは良くないが、ここでは必ずstring来るので良い */
        $serverUrl = config('grpc.server_url');
        $client = new NlpManagerClient(
            $serverUrl,
            [
                'credentials' => ChannelCredentials::createInsecure(),
            ]
        );
        $grpcRequest = new GenerateAllRequest();
        $grpcRequest->setUserId($userId);
        [$response, $status] = $client->GenerateAll($grpcRequest)->wait();
        if ($status->code !== 0) {
            Log::error('gRPC error: '.$status->details);

            return false;
        }

        return $response->start;
    }
}
