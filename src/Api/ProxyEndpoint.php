<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use JsonSerializable;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;

/**
 * @template T of Entity
 */
final class ProxyEndpoint implements JsonSerializable
{
    /**
     * @psalm-var Entity|T|null
     * @phpstan-var Entity|T|null
     */
    private ?Entity $instance = null;

    /**
     * @var class-string<T> $definition
     */
    private readonly string $definition;

    private readonly string $identifier;

    /**
     * @param class-string<T> $definition
     */
    public function __construct(
        private readonly EntityManager $entityManager,
        string $definition,
        private readonly array $resource
    ) {
        $this->definition = $definition;
        $this->identifier = $resource['name'] ?? pathinfo($this->resource['url'] ?? '', PATHINFO_FILENAME) ?? '';
    }

    /**
     * @psalm-return Entity|T
     * @phpstan-return Entity|T
     */
    private function getInstance(): Entity
    {
        if ($this->instance === null) {
            $entity = $this->definition;
            $instance = $this->entityManager->api->get($entity, $this->identifier);
            $this->instance = $instance;
        }

        return $this->instance;
    }

    public function jsonSerialize(): array
    {
        return $this->resource;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function __isset(string $property): bool
    {
        return isset($this->getInstance()->$property);
    }

    public function __get(string $property): mixed
    {
        return $this->getInstance()->$property;
    }

    public function __set(string $property, mixed $value): void
    {
        $this->getInstance()->$property = $value;
    }

    public function __call(string $method, array $arguments): mixed
    {
        return $this->getInstance()->$method(...$arguments);
    }
}
