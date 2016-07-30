<?php

namespace BroadwaySerialization\Test\Hydrate;

use BroadwaySerialization\Hydration\HydrateUsingClosurePHP7;

/**
 * @requires PHP 7.0
 */
class HydrateUsingClosurePHP7Test extends AbstractTestForHydration
{
    protected function getHydrator()
    {
        return new HydrateUsingClosurePHP7();
    }
}
