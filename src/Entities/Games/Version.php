<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Versions of the games, e.g., Red, Blue or Yellow.
 *
 * @see https://pokeapi.co/docs/v2#version
 */
#[Endpoint(Resource::VERSION)]
final readonly class Version extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        // TODO
    ) {
    }
}
