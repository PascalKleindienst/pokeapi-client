<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\Region;
use PokeDB\PokeApiClient\Entities\Moves\MoveLearnMethod;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Version groups categorize highly similar versions of the games.
 *
 * @see https://pokeapi.co/docs/v2#version-group
 */
#[Endpoint(Resource::VERSION_GROUP)]
final readonly class VersionGroup extends Entity
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

        /** @var int $order Order for sorting. Almost by date of release, except similar versions are grouped together. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation this version was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,

        /** @var Collection<MoveLearnMethod> $moveLearnMethods A list of methods in which Pokémon can learn moves in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'move_learn_methods', definition: MoveLearnMethod::class)]
        public Collection $moveLearnMethods,

        /** @var Collection<Pokedex> $pokedexes A list of Pokédexes introduces in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Pokedex::class)]
        public Collection $pokedexes,

        /** @var Collection<Region> $regions A list of regions that can be visited in this version group. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Region::class)]
        public Collection $regions,

        /** @var Collection<Version> $versions The versions this version group owns. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Version::class)]
        public Collection $versions,
    ) {
    }
}
