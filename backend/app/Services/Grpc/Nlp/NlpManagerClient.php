<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Nlp;

/**
 */
class NlpManagerClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Nlp\GenerateAllRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GenerateAll(\Nlp\GenerateAllRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/nlp.NlpManager/GenerateAll',
        $argument,
        ['\Nlp\GenerateAllResponse', 'decode'],
        $metadata, $options);
    }

}
