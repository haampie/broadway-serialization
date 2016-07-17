<?php namespace BroadwaySerialization\Hydration;

class HydrateUsingClosure implements Hydrate
{
    /** @var \Closure */
    private $hydrator;

    /**
     * @var $cache $cache[FQCN][property] = true means property exists
     */
    private $cache = [];

    public function __construct()
    {
        $this->hydrator = function (array $data, array $props) {
            foreach ($data as $key => $value) {
                if (isset($props[$key])) {
                    $this->{$key} = $value;
                }
            }
        };
    }

    public function hydrate(array $data, $object)
    {
        $class = get_class($object);

        if (!isset($this->cache[$class])) {
            foreach ((new \ReflectionObject($object))->getProperties() as $property) {
                $this->cache[$class][$property->getName()] = true;
            }
        }

        $hydrator = $this->hydrator->bindTo($object, $object);
        $hydrator($data, $this->cache[$class]);
    }
}