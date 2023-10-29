<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Entities\Games\Pokedex;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * A region is an organized area of the Pokémon world. Most often,
 * the main difference between regions is the species of Pokémon that can be encountered within them.
 *
 * @see https://pokeapi.co/docs/v2#location
 */
#[Endpoint(Resource::REGION)]
final readonly class Region extends Entity
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

        /** @var Collection<Location> $locations A list of locations that can be found in this region. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Location::class)]
        public Collection $locations,

        /** @var Collection<Collection<Name>> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var ProxyEndpoint<Generation>|Generation $mainGeneration The generation this region was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'main_generation', definition: Generation::class)]
        public ProxyEndpoint|Generation $mainGeneration,

        /** @var Collection<Pokedex> $pokedexes A list of pokédexes that catalogue Pokémon in this region. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Pokedex::class)]
        public Collection $pokedexes,

        /** @var Collection<VersionGroup> $versionGroups A list of version groups where this region can be visited. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'version_groups', definition: VersionGroup::class)]
        public Collection $versionGroups,
    ) {
    }
}
