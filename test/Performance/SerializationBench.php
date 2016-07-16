<?php namespace BroadwaySerialization\Test\Performance;

use Broadway\Serializer\SerializableInterface;
use BroadwaySerialization\Hydration\HydrateUsingReflection;
use BroadwaySerialization\Hydration\HydrateUsingReflectionFaster;
use BroadwaySerialization\Reconstitution\ReconstituteUsingInstantiatorAndHydrator;
use BroadwaySerialization\Reconstitution\Reconstitution;
use Doctrine\Instantiator\Instantiator;

class BenchSerialization
{
    /**
     * @var SerializableInterface
     */
    private $traditionalSerializableClass;

    /**
     * @var SerializableInterface
     */
    private $serializableClassUsingTrait;

    public function setup()
    {
        $this->traditionalSerializableClass = new TraditionalSerializableClass();
        $this->serializableClassUsingTrait = new SerializableClassUsingTrait();
    }

    public function setupOldReconstitute()
    {
        $reconstitute = new ReconstituteUsingInstantiatorAndHydrator(new Instantiator(), new HydrateUsingReflection());

        // test run, for calibration
        $reconstitute->objectFrom(SerializableClassUsingTrait::class, []);
        $reconstitute->objectFrom(SomeOtherSerializableClassUsingTrait::class, []);

        Reconstitution::reconstituteUsing($reconstitute);
    }

    public function setupNewReconstitute()
    {
        $reconstitute = new ReconstituteUsingInstantiatorAndHydrator(new Instantiator(),
            new HydrateUsingReflectionFaster());

        // test run, for calibration
        $reconstitute->objectFrom(SerializableClassUsingTrait::class, []);
        $reconstitute->objectFrom(SomeOtherSerializableClassUsingTrait::class, []);

        Reconstitution::reconstituteUsing($reconstitute);
    }

    /**
     * @Warmup(10)
     * @Revs(100000)
     * @Groups({"traditional"})
     * @BeforeMethods({"setup"})
     */
    public function benchSerializeObjectWithOnlyScalarProperties()
    {
        $this->traditionalSerializableClass->serialize();
    }

    /**
     * @Warmup(10)
     * @Revs(100000)
     * @Groups({"trait"})
     * @BeforeMethods({"setup","setupOldReconstitute"})
     */
    public function benchSerializeObjectWithOnlyScalarPropertiesWithTrait()
    {
        $this->serializableClassUsingTrait->serialize();
    }

    /**
     * @Warmup(10)
     * @Revs(100000)
     * @Groups({"trait"})
     * @BeforeMethods({"setup","setupNewReconstitute"})
     */
    public function benchSerializeObjectWithOnlyScalarPropertiesWithTraitNew()
    {
        $this->serializableClassUsingTrait->serialize();
    }
}