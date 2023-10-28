<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\GenerationGameIndex;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Locations that can be visited within the games. Locations make up sizable portions of regions, like cities or routes.
 *
 * @see https://pokeapi.co/docs/v2#location
 */
#[Endpoint(Resource::LOCATION)]
final readonly class Location extends Entity
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

        /** @var ProxyEndpoint<Region>|Region $region The region this location can be found in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Region::class)]
        public ProxyEndpoint|Region $region,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<GenerationGameIndex> $gameIndices A list of game indices relevent to this item by generation. */
        #[Field(FieldType::COLLECTION, apiName: 'game_indices', definition: GenerationGameIndex::class)]
        public Collection $gameIndices,

        /** @var Collection<LocationArea> $areas Areas that can be found within this location.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: LocationArea::class)]
        public Collection $areas,
    ) {
    }
}
