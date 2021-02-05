<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Simple Field Collection.
 *
 * @template-extends Collection<Field>
 * @property Field[] $elements
 * @method void add(Field|null $element) Append a field to the collection.
 * @method void set(string|int|null $key, Field|null $element) Set a field at $key in the collection.
 * @method Field|null get(string|int $key) Get the field at position $key from the collection.
 * @method Field|null first() Get the first Field of the collection.
 * @method Field|null last() Get the last Field of the collection.
 */
class FieldCollection extends Collection
{
    /**
     * @inheritDoc
     */
    protected function getExpectedClass(): ?string
    {
        return Field::class;
    }
}
