<?php

namespace BroadwaySerialization\Test\Hydrate;

use BroadwaySerialization\Hydration\HydrateUsingClosure;
use BroadwaySerialization\Test\Hydrate\Fixtures\ClassWithPrivateProperties;

class HydrateUsingClosureTest extends AbstractTestForHydration
{
    protected function getHydrator()
    {
        return new HydrateUsingClosure();
    }
}
