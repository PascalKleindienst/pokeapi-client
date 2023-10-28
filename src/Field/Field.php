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
            FieldType::STRING => (string) ($value ?? ''),
            FieldType::NUMBER => (int) $value,
            FieldType::COLLECTION => $this->getCollection($entityManager, $value ?? []),
            FieldType::TRANSLATION => $this->getTranslation($entityManager, $value ?? []),
            FieldType::NAMED_API_RESOURCE => $this->getApiResource($entityManager, $value ?? []),
            FieldType::NAMED_API_RESOURCE_LIST => $this->getApiResourceList($entityManager, $value ?? []),
            default => $value
        };
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

    private function getApiResource(EntityManager $manager, array $resource): ProxyEndpoint
    {
        if ($this->definition === null) {
            throw new InvalidArgumentException('Cannot resolve value. Missing definition');
        }

        /** @var class-string<Entity> $entity */
        $entity = $this->definition;
        return new ProxyEndpoint($manager, $entity, $resource);
    }

    /**
     * @return Collection<Entity>
     */
    private function getCollection(EntityManager $manager, array $data): Collection
    {
        /** @var Collection<Entity> $collection */
        $collection = new Collection();

        /** @var class-string<Entity> $entity */
        $entity = $this->definition;

        foreach ($data as $resource) {
            $collection->add($manager->create($entity, $resource));
        }

        return $collection;
    }

    public function getTranslation(EntityManager $manager, array $data): Collection
    {
        /** @var Collection<Entity> $collection */
        $collection = new Collection();

        /** @var class-string<Entity> $entity */
        $entity = $this->definition;

        foreach ($data as $resource) {
            $collection->set($resource['language']['name'], $manager->create($entity, $resource));
        }

        return $collection;
    }
}
