<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: nlp.proto

namespace Nlp;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>nlp.GenerateAllRequest</code>
 */
class GenerateAllRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>uint32 userId = 1;</code>
     */
    protected $userId = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $userId
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Nlp::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>uint32 userId = 1;</code>
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Generated from protobuf field <code>uint32 userId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setUserId($var)
    {
        GPBUtil::checkUint32($var);
        $this->userId = $var;

        return $this;
    }

}

