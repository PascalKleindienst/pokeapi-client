<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use InvalidArgumentException;
use PokeDB\PokeApiClient\Utils\Struct;

/**
 * Abstract Entity Class.
 */
abstract class Entity extends Struct implements \JsonSerializable
{
    /**
     * Get property of entity.
     *
     * @throws InvalidArgumentException if property does not exist
     * @param string $property
     * @return mixed
     */
    public function get(string $property)
    {
        if ($this->has($property)) {
            return $this->$property;
        }

        throw new InvalidArgumentException(
            sprintf('Property %s do not exist in class %s', $property, static::class)
        );
    }

    /**
     * Checks if entity has a specific property.
     *
     * @param string $property
     * @return bool
     */
    public function has(string $property): bool
    {
        return property_exists($this, $property);
    }
}
