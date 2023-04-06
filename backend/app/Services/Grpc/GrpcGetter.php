<?php
declare(strict_types=1);

namespace App\Services\Grpc;
use GrpcClient\Nlp\GenerateAllRequest;
use Grpc\ChannelCredentials;
use GrpcClient\Nlp\NlpManagerClient;

class GrpcGetter
{
    public function getGrpcRequest(int $userId):bool
    {
        $client = new NlpManagerClient('nlp:2020',
        [
            'credentials' => ChannelCredentials::createInsecure(),
        ]
    );
        $grpcRequest = new GenerateAllRequest();
        $grpcRequest->setUserId($userId);
        list($response, $status) = $client->GenerateAll($grpcRequest)->wait();
        return $response->start;
    }
}
