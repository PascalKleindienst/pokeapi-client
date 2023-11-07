<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\LocationArea;
use PokeDB\PokeApiClient\Entities\Utility\VersionEncounterDetail;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Pokémon Location Areas are ares where Pokémon can be found.
 *
 * @see https://pokeapi.co/docs/v2#pokemon-location-areas
 */
#[Endpoint(Resource::POKEMON_LOCATION_AREA)]
final readonly class LocationAreaEncounter extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(public Collection $locationAreas)
    {
    }
}
