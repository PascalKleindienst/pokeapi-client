<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use InvalidArgumentException;

/**
 * Simple Collection Data Structure.
 *
 * @template T
 */
class Collection extends Struct implements \IteratorAggregate, \Countable
{
    /**
     * @psalm-var T[]
     * @var array
     */
    protected $elements = [];

    /**
     * @param iterable $elements
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
     * @param mixed|null $element
     * @return void
     */
    public function add($element): void
    {
        $this->validateType($element);

        $this->elements[] = $element;
    }

    /**
     * Set an element in the collection.
     *
     * @psalm-param T $element
     * @param string|int|null $key
     * @param mixed|null $element
     * @return void
     */
    public function set($key, $element): void
    {
        $this->validateType($element);

        if ($key === null) {
            $this->elements[] = $element;

            return;
        }

        $this->elements[$key] = $element;
    }

    /**
     * Get an element from the collection.
     *
     * @psalm-return T|null $element
     * @param string|int $key
     * @return mixed|null
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->elements[$key];
        }

        return null;
    }

    /**
     * Clear collection.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * Count the number of elements in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return \count($this->elements);
    }

    /**
     * Get the keys of the collection elements.
     *
     * @return array
     */
    public function getKeys(): array
    {
        return array_keys($this->elements);
    }

    /**
     * Checks if the collection contains an element.
     *
     * @param string|int $key
     * @return bool
     */
    public function has($key): bool
    {
        return \array_key_exists($key, $this->elements);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->elements;
    }

    /**
     * Return array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * Get the first element of the collection.
     *
     * @psalm-return T|null
     * @return mixed|null
     */
    public function first()
    {
        return array_values($this->elements)[0] ?? null;
    }

    /**
     * Get the last element of the collection.
     *
     * @psalm-return T|null
     * @return mixed|null
     */
    public function last()
    {
        return array_values($this->elements)[\count($this->elements) - 1] ?? null;
    }

    /**
     * @param int|string $key
     */
    public function remove($key): void
    {
        unset($this->elements[$key]);
    }

    /**
     * Yield thhe current iterator.
     *
     * @return \Generator
     */
    public function getIterator(): \Generator
    {
        yield from $this->elements;
    }

    /**
     * Get the expected class.
     *
     * Used to simulate generic collections, ie Collection<SomeType>
     *
     * @psalm-template RealObjectType of object
     * @psalm-return class-string<RealObjectType>|null
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return null;
    }

    /**
     * Validate if element is of expected class.
     *
     * @psalm-param T $element
     * @throws InvalidArgumentException if element is not of expected class
     * @param mixed $element
     * @return void
     */
    protected function validateType($element): void
    {
        $expectedClass = $this->getExpectedClass();
        if ($expectedClass === null) {
            return;
        }

        if (!$element instanceof $expectedClass) {
            $elementClass = \get_class($element);

            throw new InvalidArgumentException(
                sprintf('Expected collection element of type %s got %s', $expectedClass, $elementClass)
            );
        }
    }
}
