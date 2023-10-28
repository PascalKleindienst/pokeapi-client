<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Types are properties for Pokémon and their moves. Each type has three properties:
 * which types of Pokémon it is super effective against, which types of Pokémon it is not very effective against,
 * and which types of Pokémon it is completely ineffective against.
 *
 * @see https://pokeapi.co/docs/v2#version
 */
#[Endpoint(Resource::TYPE)]
final readonly class Type extends Entity
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
