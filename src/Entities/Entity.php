<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use JsonException;
use JsonSerializable;
use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Exceptions\NetworkException;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Utils\ResourceIdentifier;
use Psr\Cache\InvalidArgumentException;
use ReflectionAttribute;
use ReflectionException;
use ReflectionProperty;

abstract class Entity implements JsonSerializable
{
    /**
     * @var array<string, ResourceIdentifier>
     */
    protected array $endpoints = [];

    public function addEndpoint(string $property, ResourceIdentifier $resource): void
    {
        $this->endpoints[$property] = $resource;
    }

    /**
     * Get the foreign key of a lazy loaded property.
     */
    public function getForeignKey(string $property): ?ResourceIdentifier
    {
        return $this->endpoints[$property] ?? null;
    }

    /**
     * Lazy Load an uninitialized property.
     * @throws JsonException if there is some JSON Error with the api response
     * @throws NetworkException if there is some network error while fetching the API
     * @throws InvalidArgumentException if we cannot lazy load the property
     * @throws ReflectionException
     */
    public function __get(string $name): mixed
    {
        $property = new ReflectionProperty($this, $name);

        /** @var ReflectionAttribute<Field>|null $field */
        $field = $property->getAttributes(Field::class)[0] ?? null;

        if ($field) {
            $attr = $field->newInstance();
            $resource = $this->endpoints[$name] ?? null;

            // if we have a resource identifier and a definition, we can lazy load it
            if ($resource?->identifier && $attr->definition) {
                $property->setValue($this, Api::getInstance()?->get($attr->definition, $resource->identifier));
                return $property->getValue($this);
            }

            // Otherwise, throw an exception
            throw new \InvalidArgumentException('Could not lazy load the property ' . $name . ' for ' . \get_class($this));
        }

        return $property->getValue($this);
    }

    public function jsonSerialize(): array
    {
        $data = get_object_vars($this);
        $props = (new \ReflectionClass($this))->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            if (\array_key_exists($prop->getName(), $data)){
                unset($data[$prop->getName()]);
            }
        }

        return $data;
    }

    public function toJson(): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR);
    }
}
