<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * A region is an organized area of the Pokémon world. Most often,
 * the main difference between regions is the species of Pokémon that can be encountered within them.
 *
 * @see https://pokeapi.co/docs/v2#location
 */
#[Endpoint(Resource::REGION)]
final readonly class Region extends Entity
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
