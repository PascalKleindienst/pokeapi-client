<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use Generator;
use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * @template T of Entity
 * @extends Collection<T>
 */
class ApiResourceCollection extends Collection
{
    /**
     * @var class-string<T>
     */
    private string $resource;

    /**
     * @var ResourceIdentifier[]
     */
    private array $lazyEntries = [];

    /**
     * @param class-string<T> $entity
     * @param ResourceIdentifier[] $resources
     * @return self
     */
    public static function create(string $entity, array $resources): ApiResourceCollection
    {
        $collection = new self();
        $collection->resource = $entity;
        $collection->lazyEntries = $resources;
        return $collection;
    }

    /**
     * @return string[]
     */
    public function getForeignKeys(): array
    {
        $data = [];
        foreach ($this->lazyEntries as $element) {
            if ($element->identifier) {
                $data[] = $element->identifier;
            }
        }

        return $data;
    }

    public function has(string|int $key): bool
    {
        if (\array_key_exists($key, $this->lazyEntries)) {
            return true;
        }

        return parent::has($key);
    }

    /**
     * @inheritDoc
     */
    public function get(string|int $key): mixed
    {
        if (\array_key_exists($key, $this->elements)) {
            return parent::get($key);
        }

        // Load the resource
        if (\array_key_exists($key, $this->lazyEntries) && $this->lazyEntries[$key]->identifier) {
            /** @var T|null $result */
            $result = Api::getInstance()?->get($this->resource, $this->lazyEntries[$key]->identifier);

            if ($result === null) {
                return null;
            }

            $this->elements[$key] = $result;
            return $result;
        }

        return null;
    }

    public function count(): int
    {
        return \count($this->lazyEntries);
    }

    public function first(): mixed
    {
        if (empty($this->lazyEntries)) {
            return null;
        }

        return $this->get(array_key_first($this->lazyEntries));
    }

    public function last(): mixed
    {
        if (empty($this->lazyEntries)) {
            return null;
        }

        return $this->get(array_key_last($this->lazyEntries));
    }

    public function all(): array
    {
        foreach (array_keys($this->lazyEntries) as $key) {
            $this->get($key);
        }

        return parent::all();
    }

    public function getIterator(): Generator
    {
        foreach (array_keys($this->lazyEntries) as $key) {
            $data = $this->get($key);
            if ($data !== null) {
                yield $key => $data;
            }
        }
    }
}
