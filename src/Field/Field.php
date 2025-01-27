<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Field;

use Attribute;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;
use PokeDB\PokeApiClient\Utils\Collection;
use PokeDB\PokeApiClient\Utils\ResourceIdentifier;
use ReflectionException;
use TypeError;

/**
 * @template T of Entity
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final readonly class Field
{
    /**
     * @var class-string<T>|null
     */
    public ?string $definition;

    /**
     * @param class-string<T>|null $definition
     */
    public function __construct(
        public FieldType $type,
        public ?string $apiName = null,
        ?string $definition = null
    ) {
        $this->definition = $definition;

        if ($this->definition !== null && ! is_a($this->definition, Entity::class, true)) {
            throw new TypeError(
                'Invalid type for $definition. Expected ' . Entity::class . ' got ' . $this->definition
            );
        }
    }

    public function getParameters(EntityManager $entityManager, array $data, string $key): mixed
    {
        $property = $this->apiName ?? $key;
        $value = $data[$property] ?? null;

        try {
            return match ($this->type) {
                FieldType::STRING => empty($value) ? null : (string) $value,
                FieldType::BOOLEAN => (bool) $value,
                FieldType::NUMBER => (int) $value,
                FieldType::LIST => (array) $value,
                FieldType::ENTITY => $this->createEntity($entityManager, $value ?? []),
                FieldType::COLLECTION => $this->getCollection($entityManager, $value ?? []),
                FieldType::TRANSLATION => $this->getTranslation($entityManager, $value ?? []),
                FieldType::NAMED_API_RESOURCE => $value ?? [],
                FieldType::NAMED_API_RESOURCE_LIST => $this->definition
                    ? ApiResourceCollection::create($this->definition, array_map(static fn(array $res) => new ResourceIdentifier($res),$value ?? []))
                    : null
            };
        } catch (ReflectionException) {
            return null;
        }
    }

    /**
     * @throws ReflectionException
     */
    private function createEntity(EntityManager $manager, array $data): Entity
    {
        /** @var class-string<Entity> $entity */
        $entity = $this->definition;

        return $manager->create($entity, $data);
    }

    /**
     * @return Collection<Entity>|Collection<mixed>
     * @throws ReflectionException
     */
    private function getCollection(EntityManager $manager, array $data): Collection
    {
        if (empty($this->definition)) {
            return new Collection($data);
        }

        /** @var Collection<Entity> $collection */
        $collection = new Collection();
        foreach ($data as $resource) {
            $collection->add($this->createEntity($manager, $resource));
        }

        return $collection;
    }

    /**
     * @return Collection<Entity>
     * @throws ReflectionException
     */
    public function getTranslation(EntityManager $manager, array $data): Collection
    {
        /** @var Collection<Entity> $collection */
        $collection = new Collection();
        foreach ($data as $resource) {
            $resource['locale'] = $resource['language']['name'];
            $collection->add($this->createEntity($manager, $resource));
        }

        return $collection;
    }
}
