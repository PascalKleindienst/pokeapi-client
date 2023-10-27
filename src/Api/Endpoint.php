<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Endpoint
{
    public function __construct(public Resource $resource)
    {
    }
}
