<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Pokémon Location Areas are ares where Pokémon can be found.
 *
 * @see https://pokeapi.co/docs/v2#pokemon-location-areas
 */
#[Endpoint(Resource::POKEMON_LOCATION_AREA)]
final class LocationAreaEncounter extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<LocationAreaItem> $locationAreas The location areas where the referenced Pokémon can be found. */
        public Collection $locationAreas)
    {
    }
}
