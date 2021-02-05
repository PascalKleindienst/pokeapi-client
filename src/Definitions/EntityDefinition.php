<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use InvalidArgumentException;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\Field;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\Collection;
use ReflectionClass;

/**
 * Abstract Entity Definition class.
 */
abstract class EntityDefinition
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Set the client.
     *
     * @param ClientInterface $client
     * @return EntityDefinition
     */
    public function setClient(ClientInterface $client): EntityDefinition
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get the client.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Get the entity class.
     *
     * @psalm-template RealObjectType of object
     * @psalm-return class-string<RealObjectType>
     * @return string
     */
    abstract public function getEntityClass(): string;

    /**
     * Get the api endpoint.
     *
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * Define the fields of this entity.
     *
     * @return FieldCollection
     */
    abstract protected function defineFields(): FieldCollection;

    /**
     * Get the Entity Collcetion Class.
     *
     * @psalm-template RealObjectType of object
     * @psalm-return class-string<RealObjectType>
     * @return string
     */
    public function getEntityCollection(): string
    {
        return Collection::class;
    }

    /**
     * Create a new instance of the entity collection.
     *
     * @return Collection
     */
    public function createEntityCollection(): Collection
    {
        $className = $this->getEntityCollection();
        $collection = new $className();

        if (!$collection instanceof Collection) {
            throw new InvalidArgumentException('Collection class ' . $className . ' is not of type Collection!');
        }

        return $collection;
    }

    /**
     * Resolve the field definitions.
     *
     * @template T of Entity
     * @psalm-return T
     * @param array $data
     * @return Entity
     */
    public function resolve(array $data): Entity
    {
        $reflection = new ReflectionClass($this->getEntityClass());
        $entity = $reflection->newInstanceWithoutConstructor();
        $fields = $this->defineFields();

        foreach ($fields as $field) {
            /** @var Field $field */
            if ($reflection->hasProperty($field->getPropertyName())) {
                $property = $reflection->getProperty($field->getPropertyName());
                $property->setAccessible(true);
                $property->setValue($entity, $field->resolve($data, $this->client));
            }
        }

        return $entity;
    }
}
