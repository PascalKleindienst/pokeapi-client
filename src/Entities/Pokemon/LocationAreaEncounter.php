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
    public function __construct(
        /** @var ProxyEndpoint<LocationArea>|LocationArea $locationArea The location area the referenced Pokémon can be encountered in. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'location_area', definition: LocationArea::class)]
        public ProxyEndpoint|LocationArea $locationArea,

        /** @var Collection<VersionEncounterDetail> $versionDetails A list of versions and encounters with the referenced Pokémon that might happen. */
        #[Field(FieldType::COLLECTION, apiName: 'version_details', definition: VersionEncounterDetail::class)]
        public Collection $versionDetails,
    ) {
    }
}
