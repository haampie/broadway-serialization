<?php

namespace BroadwaySerialization\Test\Serialization\Fixtures;

use Broadway\Serializer\Serializable as SerializableInterface;
use BroadwaySerialization\Serialization\Serializable;

class SerializableObjectWithNoCallbacks implements SerializableInterface
{
    use Serializable;

    private $bar;

    public function __construct($bar)
    {
        $this->bar = $bar;
    }
}
