<?php

namespace BroadwaySerialization\Test\Hydrate;

use BroadwaySerialization\Hydration\HydrateUsingClosure;
use BroadwaySerialization\Test\Hydrate\Fixtures\ClassWithPrivateProperties;

class HydrateUsingClosureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_hydrates_an_object_with_private_properties()
    {
        $object = new ClassWithPrivateProperties();

        $hydrate = new HydrateUsingClosure();
        $hydrate->hydrate(['foo' => 'bar'], $object);

        $this->assertSame('bar', $object->foo());
    }

    /**
     * @test
     */
    public function it_ignores_keys_that_are_not_defined_in_the_data_array()
    {
        $object = new ClassWithPrivateProperties();

        $hydrate = new HydrateUsingClosure();

        // 'foo' is not defined, which should be no problem
        $hydrate->hydrate([], $object);

        $this->assertSame(null, $object->foo());
    }

    /**
     * @test
     */
    public function it_ignores_extra_keys_in_the_data_array()
    {
        $object = new ClassWithPrivateProperties();

        $hydrate = new HydrateUsingClosure();

        // 'extra' is not a property, which should be no problem
        $hydrate->hydrate(['extra' => 'no problem', 'foo' => 'bar'], $object);

        $this->assertSame('bar', $object->foo());
    }
}
