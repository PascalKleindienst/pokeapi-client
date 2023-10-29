<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Stats determine certain aspects of battles.
 *
 * Each Pokémon has a value for each stat which grows as they gain levels and can be altered
 * momentarily by effects in battles.
 *
 * @see https://pokeapi.co/docs/v2#stat
 */
#[Endpoint(Resource::STAT)]
final readonly class Stat extends Entity
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
