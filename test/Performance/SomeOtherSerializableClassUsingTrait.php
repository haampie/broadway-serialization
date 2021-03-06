<?php

namespace BroadwaySerialization\Test\Performance;

use Broadway\Serializer\SerializableInterface;
use BroadwaySerialization\Serialization\Serializable;

class SomeOtherSerializableClassUsingTrait implements SerializableInterface
{
    use Serializable;

    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}
