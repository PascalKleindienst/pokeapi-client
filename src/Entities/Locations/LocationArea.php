<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Location areas are sections of areas, such as floors in a building or cave.
 * Each area has its own set of possible Pokémon encounters.
 *
 * @see https://pokeapi.co/docs/v2#location
 */
#[Endpoint(Resource::LOCATION_AREA)]
final readonly class LocationArea extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var int $gameIndex The internal id of an API resource within game data. */
        #[Field(FieldType::NUMBER, apiName: 'game_index')]
        public int $gameIndex,

        /** @var Collection<EncounterMethodRate> $encounterMethodRates A list of methods in which Pokémon may be encountered in this area and how likely the method will occur depending on the version of the game. */
        #[Field(FieldType::COLLECTION, apiName: 'encounter_method_rates', definition: EncounterMethodRate::class)]
        public Collection $encounterMethodRates,

        /** @var ProxyEndpoint<Location>|Location $location The region this location area can be found in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Location::class)]
        public ProxyEndpoint|Location $location,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<PokemonEncounter> $pokemonEncounters A list of Pokémon that can be encountered in this area along with version specific details about the encounter. */
        #[Field(FieldType::COLLECTION, apiName: 'pokemon_encounters', definition: PokemonEncounter::class)]
        public Collection $pokemonEncounters,
    ) {
    }
}
