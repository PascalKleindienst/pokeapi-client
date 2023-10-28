<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Pokémon are the creatures that inhabit the world of the Pokémon games.
 *
 * They can be caught using Pokéballs and trained by battling with other Pokémon. Each Pokémon belongs to
 * a specific species but may take on a variant which makes it differ from other Pokémon of the same species,
 * such as base stats, available abilities and typings. See Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#ability
 */
#[Endpoint(Resource::POKEMON)]
final readonly class Pokemon extends Entity
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
