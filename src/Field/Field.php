<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Field;

use Attribute;
use InvalidArgumentException;
use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;
use PokeDB\PokeApiClient\Utils\Collection;
use TypeError;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final readonly class Field
{
    /**
     * @template T of Entity
     * @psalm-var string|class-string<T>|null
     * @phpstan-var string|class-string<T>|null
     */
    public ?string $definition;

    public function __construct(
        public FieldType $type,
        public ?string $apiName = null,
        ?string $definition = null
    ) {
        $this->definition = $definition;

        if ($this->definition !== null && !is_a($this->definition, Entity::class, true)) {
            throw new TypeError(
                'Invalid type for $definition. Expected ' . Entity::class . ' got ' . $this->definition
            );
        }
    }

    public function getParameters(EntityManager $entityManager, array $data, string $key): mixed
    {
        $property = $this->apiName ?? $key;
        $value = $data[$property] ?? null;

        return match ($this->type) {
            FieldType::STRING => empty($value) ? null : (string) $value,
            FieldType::BOOLEAN => (bool) $value,
            FieldType::NUMBER => (int) $value,
            FieldType::LIST => (array) $value,
            FieldType::ENTITY => $this->createEntity($entityManager, $value ?? []),
            FieldType::COLLECTION => $this->getCollection($entityManager, $value ?? []),
            FieldType::TRANSLATION => $this->getTranslation($entityManager, $value ?? []),
            FieldType::NAMED_API_RESOURCE => $this->getApiResource($entityManager, $value ?? []),
            FieldType::NAMED_API_RESOURCE_LIST => $this->getApiResourceList($entityManager, $value ?? []),
        };
    }

    private function createEntity(EntityManager $manager, array $data): Entity
    {
        /** @var class-string<Entity> $entity */
        $entity = $this->definition;
        return $manager->create($entity, $data);
    }

    /**
     * @return Collection<ProxyEndpoint>
     */
    private function getApiResourceList(EntityManager $manager, array $resources): Collection
    {
        if ($this->definition === null) {
            throw new InvalidArgumentException('Cannot resolve value. Missing definition');
        }

        /** @var Collection<ProxyEndpoint> $collection */
        $collection = new Collection();
        foreach ($resources as $resource) {
            $collection->add($this->getApiResource($manager, $resource));
        }

        return $collection;
    }

    private function getApiResource(EntityManager $manager, array $resource): ?ProxyEndpoint
    {
        if ($this->definition === null) {
            throw new InvalidArgumentException('Cannot resolve value. Missing definition');
        }

        if (empty($resource)) {
            return null;
        }

        /** @var class-string<Entity> $entity */
        $entity = $this->definition;
        return new ProxyEndpoint($manager, $entity, $resource);
    }

    /**
     * @return Collection<Entity>|Collection<mixed>
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
