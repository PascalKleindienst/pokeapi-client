<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Field\Field;
use ReflectionClass;

final class EntityManager
{
    /**
     * @var ReflectionClass[]
     */
    private array $refClasses = [];

    public function __construct(public readonly Api $api)
    {
    }

    /**
     * @template T of Entity
     * @param class-string<T> $entity
     * @param array $data
     * @psalm-return T
     * @return Entity
     */
    public function create(string $entity, array $data): Entity
    {
        // TODO: Type Check for entity

        // Save Reflection class in-memory for later use
        if (!\array_key_exists($entity, $this->refClasses)) {
            $this->refClasses[$entity] = new ReflectionClass($entity);
        }

        $params = $this->refClasses[$entity]->getConstructor()?->getParameters() ?? [];
        $constructor = [];

        foreach ($params as $param) {
            $attr = $param->getAttributes(Field::class)[0] ?? null;
            $name = $param->getName();
            $constructor[$name] = $data[$name] ?? null;

            // Get data value via field attribute
            if ($attr) {
                $field = $attr->newInstance();
                $constructor[$name] = $field->getParameters($this, $data, $name) ?? $constructor[$name];
            }
        }

        /** @var T $instance */
        $instance = $this->refClasses[$entity]->newInstance(...$constructor);
        return $instance;
    }
}
