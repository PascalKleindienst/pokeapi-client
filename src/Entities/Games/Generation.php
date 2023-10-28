<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\Region;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Entities\Pokemon\Ability;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Entities\Pokemon\Type;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * A generation is a grouping of the Pokémon games that separates them based on the Pokémon they include.
 * In each generation, a new set of Pokémon, Moves, Abilities and Types that did not exist
 * in the previous generation are released.
 *
 * @see https://pokeapi.co/docs/v2#version
 */
#[Endpoint(Resource::GENERATION)]
final readonly class Generation extends Entity
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

        /** @var Collection<Ability> $abilities A list of abilities that were introduced in this generation.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Ability::class)]
        public Collection $abilities,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var ProxyEndpoint<Region>|Region $mainRegion The main region travelled in this generation.. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'main_region', definition: Region::class)]
        public ProxyEndpoint|Region $mainRegion,

        /** @var Collection<Move> $moves A list of moves that were introduced in this generation. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Move::class)]
        public Collection $moves,

        /** @var Collection<PokemonSpecies> $pokemonSpecies A list of Pokémon species that were introduced in this generation. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public Collection $pokemonSpecies,

        /** @var Collection<Type> $types A list of types that were introduced in this generation. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Type::class)]
        public Collection $types,

        /** @var Collection<VersionGroup> $versionGroups A list of version groups that were introduced in this generation. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'version_groups', definition: VersionGroup::class)]
        public Collection $versionGroups,
    ) {
    }
}
