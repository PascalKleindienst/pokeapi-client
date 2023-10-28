<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\Pokemon;
use PokeDB\PokeApiClient\Entities\Utility\VersionEncounterDetail;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemonencounter
 */
final readonly class PokemonEncounter extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Pokemon>|Pokemon $pokemon The Pokémon being encountered. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public ProxyEndpoint|Pokemon $pokemon,

        /** @var Collection<VersionEncounterDetail> $versionDetails A list of versions and encounters with Pokémon that might happen in the referenced location area.*/
        #[Field(FieldType::COLLECTION, apiName: 'version_details', definition: VersionEncounterDetail::class)]
        public Collection $versionDetails,
    ) {
    }
}
