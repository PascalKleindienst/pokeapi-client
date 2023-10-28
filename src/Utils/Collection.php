<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use Countable;
use Generator;
use IteratorAggregate;
use JsonSerializable;

/**
 * Simple Collection Data Structure.
 *
 * @template T
 * @template-implements IteratorAggregate<T>
 */
class Collection implements IteratorAggregate, Countable, JsonSerializable
{
    /**
     * @var array<T>
     */
    protected array $elements = [];

    /**
     * @param iterable<int|string, T> $elements
     */
    public function __construct(iterable $elements = [])
    {
        foreach ($elements as $key => $element) {
            $this->set($key, $element);
        }
    }

    /**
     * Append an element to the collection.
     *
     * @psalm-param T $element
     */
    public function add(mixed $element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Set an element in the collection.
     *
     * @psalm-param int|string|null $key
     * @psalm-param T $element
     */
    public function set(string|int|null $key, mixed $element): void
    {
        if ($key === null) {
            $this->elements[] = $element;

            return;
        }

        $this->elements[$key] = $element;
    }

    /**
     * Get an element from the collection.
     *
     * @psalm-param int|string $key
     * @psalm-return T|null $element
     */
    public function get(string|int $key): mixed
    {
        if ($this->has($key)) {
            return $this->elements[$key];
        }

        return null;
    }

    /**
     * Clear collection.
     */
    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * Count the number of elements in the collection.
     */
    public function count(): int
    {
        return \count($this->elements);
    }

    /**
     * Get the keys of the collection elements.
     */
    public function getKeys(): array
    {
        return array_keys($this->elements);
    }

    /**
     * Checks if the collection contains an element.
     */
    public function has(string|int $key): bool
    {
        return \array_key_exists($key, $this->elements);
    }

    public function jsonSerialize(): array
    {
        return $this->elements;
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * Get the first element of the collection.
     *
     * @psalm-return T|null
     */
    public function first(): mixed
    {
        return array_values($this->elements)[0] ?? null;
    }

    /**
     * Get the last element of the collection.
     *
     * @psalm-return T|null
     */
    public function last(): mixed
    {
        return array_values($this->elements)[\count($this->elements) - 1] ?? null;
    }

    /**
     * @param callable(T): bool $filter
     * @return self
     */
    public function filter(callable $filter): self
    {
        return new self(array_filter($this->elements, $filter));
    }

    public function remove(int|string $key): void
    {
        unset($this->elements[$key]);
    }

    /**
     * Yield thhe current iterator.
     *
     * @return Generator
     */
    public function getIterator(): Generator
    {
        yield from $this->elements;
    }
}
