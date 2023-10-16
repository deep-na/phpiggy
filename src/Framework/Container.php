<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ContainerExceptions;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $definitions = [];

    // For singleton, contains all the initiated instances
    private array $resolved = [];

    function addDefinition(array $newDef)
    {
        $this->definitions = [...$this->definitions, ...$newDef];

        //debugVar($newDef);
    }

    public function resolve(string $className)
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerExceptions("The class in not Instantiable: {$className}");
        }

        $contructor = $reflectionClass->getConstructor();

        if (!$contructor) {
            return new $className;
        }

        $params = $contructor->getParameters();

        if (count($params) === 0) {
            return new $className;
        }

        // validating the params

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new ContainerExceptions("Failed to resolve class {$className} because param {$name} is missing!");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerExceptions("Failed to resolve class {$className} cause of ivalid param name");
            }

            $dependencies[] = $this->get($type->getName());
        }

        // echo "<pre>";
        return $reflectionClass->newInstanceArgs($dependencies);
        //echo "</pre>";
    }


    function get(string $id)
    {

        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerExceptions("class {$id} key given does not exist");
        }

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];

        $dependency = $factory($this);
        $this->resolved[$id] = $dependency;
        return $dependency;
    }
}
