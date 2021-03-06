<?php

namespace BroadwaySerialization\Reconstitution;

interface Reconstitute
{
    /**
     * Reconstitute an object by creating an instance of the given class name, then copying the provided data into its
     * properties.
     *
     * @param string $className
     * @param array $data
     * @return object of type $className
     */
    public function objectFrom($className, array $data);
}
