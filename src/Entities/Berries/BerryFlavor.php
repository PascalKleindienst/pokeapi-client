<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Berries;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\ContestType;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\FlavorBerryMap;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Flavors determine whether a Pokémon will benefit or suffer from eating a berry based on their nature.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#berry-flavors
 */
#[Endpoint(Resource::BERRY_FLAVOR)]
class BerryFlavor extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public readonly int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public readonly string $name,

        /** @var Collection<FlavorBerryMap> $berries A list of the berries with this flavor. */
        #[Field(FieldType::COLLECTION, definition: FlavorBerryMap::class)]
        public readonly Collection $berries,

        /** @var Collection $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'name')]
        public readonly Collection $names,

        /** @var ProxyEndpoint<ContestType>|ContestType $contestType The contest type that correlates with this berry flavor. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: ContestType::class)]
        public readonly ProxyEndpoint|ContestType $contestType,
    ) {
    }
}
