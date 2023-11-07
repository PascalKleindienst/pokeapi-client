<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\Region;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * A Pokédex is a handheld electronic encyclopedia device;
 * one which is capable of recording and retaining information of the various Pokémonin a given region
 * with the exception of the national dex and some smaller dexes related to portions of a region.
 *
 * @see https://pokeapi.co/docs/v2#pokedexes
 */
#[Endpoint(Resource::POKEDEX)]
final readonly class Pokedex extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var bool $isMainSeries Whether or not this Pokédex originated in the main series of the video games.. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_main_series')]
        public bool $isMainSeries,

        /** @var Collection<Description> $descriptions The description of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<PokemonEntry> $pokemonEntries A list of Pokémon catalogued in this Pokédex and their indexes. */
        #[Field(FieldType::COLLECTION, apiName: 'pokemon_entries', definition: PokemonEntry::class)]
        public Collection $pokemonEntries,

        /** @var ProxyEndpoint<Region>|Region|null $region The region this Pokédex catalogues Pokémon for. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Region::class)]
        public ProxyEndpoint|Region|null $region,

        /** @var Collection<VersionGroup> $versionGroups A list of version groups this Pokédex is relevant to. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'version_groups', definition: VersionGroup::class)]
        public Collection $versionGroups,
    ) {
    }
}