<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use JsonSerializable;

/**
 * Abstract Entity Class.
 */
abstract readonly class Entity implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function toJson(): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR);
    }
}
