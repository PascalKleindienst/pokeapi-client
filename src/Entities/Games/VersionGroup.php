<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\Region;
use PokeDB\PokeApiClient\Entities\Moves\MoveLearnMethod;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;

/**
 * Version groups categorize highly similar versions of the games.
 *
 * @see https://pokeapi.co/docs/v2#version-group
 */
#[Endpoint(Resource::VERSION_GROUP)]
final class VersionGroup extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var int $order Order for sorting. Almost by date of release, except similar versions are grouped together. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var Generation $generation The generation this version was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public Generation|null $generation,

        /** @var ApiResourceCollection<MoveLearnMethod> $moveLearnMethods A list of methods in which Pokémon can learn moves in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'move_learn_methods', definition: MoveLearnMethod::class)]
        public ApiResourceCollection $moveLearnMethods,

        /** @var ApiResourceCollection<Pokedex> $pokedexes A list of Pokédexes introduces in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Pokedex::class)]
        public ApiResourceCollection $pokedexes,

        /** @var ApiResourceCollection<Region> $regions A list of regions that can be visited in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Region::class)]
        public ApiResourceCollection $regions,

        /** @var ApiResourceCollection<Version> $versions The versions this version group owns. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Version::class)]
        public ApiResourceCollection $versions,
    ) {
    }
}
