<?php

namespace BroadwaySerialization\Test\Hydrate;

use BroadwaySerialization\Hydration\HydrateUsingReflection;

class HydrateUsingReflectionTest extends AbstractTestForHydration
{
    protected function getHydrator()
    {
        return new HydrateUsingReflection();
    }
}
