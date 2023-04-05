<?php
declare(strict_type=1);

namespace App\Services\Grpc;
use GrpcClient\Nlp\GenerateAllRequest;
use Grpc\ChannelCredentials;
use GrpcClient\Nlp\NlpManagerClient;

class GrpcGetter
{
    public function getGrpcRequest(int $userId):bool
    {
        $client = new NlpManagerClient('nlp:1000',
        [
            'credentials' => ChannelCredentials::createInsecure(),
        ]
    );
        $grpcRequest = new GenerateAllRequest();
        $grpcRequest->setUserId($userId);
        list($response, $status) = $client->GenerateAll($grpcRequest)->wait();
        dd($status);
        return $response->start;
    }
}
