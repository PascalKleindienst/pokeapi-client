<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use Generator;
use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * @template T of Entity
 *
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
     * @param  class-string<T>  $entity
     * @param  ResourceIdentifier[]  $resources
     */
    public static function create(string $entity, array $resources): ApiResourceCollection
    {
        $collection = new self;
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
     * {@inheritDoc}
     */
    public function get(string|int $key): mixed
    {
        if (\array_key_exists($key, $this->elements)) {
            return parent::get($key);
        }

        // Load the resource
        if (\array_key_exists($key, $this->lazyEntries) && $this->lazyEntries[$key]->identifier) {
            /** @var T|null $result */
            $result = $this->initialize($key);

            if ($result === null) {
                return null;
            }

            // TODO: This is a memory issue when we have a lot of entities like for a nationaldex -> we should not store all of them in memory
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
            if (\array_key_exists($key, $this->elements)) {
                yield parent::get($key);
            }

            yield $key => $this->initialize($key);
        }
    }

    /**
     * @return T|null
     *
     * @throws \JsonException
     * @throws \PokeDB\PokeApiClient\Exceptions\NetworkException
     * @throws \Psr\Cache\CacheException
     * @throws \ReflectionException
     */
    protected function initialize(int|string $key)
    {
        return Api::getInstance()?->get($this->resource, $this->lazyEntries[$key]->id ?? $this->lazyEntries[$key]->identifier);
    }
}
