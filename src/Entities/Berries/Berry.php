<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Berries;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Item;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Berries are small fruits that can provide HP and status condition restoration, stat enhancement,
 * and even damage negation when eaten by Pokémon.
 *
 * @see https://pokeapi.co/docs/v2#berries
 */
#[Endpoint(Resource::BERRY)]
class Berry extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public readonly int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public readonly string $name,

        /** @var int $growthTime Time it takes the tree to grow one stage, in hours. */
        #[Field(FieldType::NUMBER, 'growth_time')]
        public readonly int $growthTime,

        /** @var int $maxHarvest The maximum number of these berries that can grow on one tree in Generation IV. */
        #[Field(FieldType::NUMBER, 'max_harvest')]
        public readonly int $maxHarvest,

        /** @var int $naturalGiftPower The power of the move "Natural Gift" when used with this Berry. */
        #[Field(FieldType::NUMBER, 'natural_gift_power')]
        public readonly int $naturalGiftPower,

        /** @var int $size The size of this Berry, in millimeters. */
        #[Field(FieldType::NUMBER)]
        public readonly int $size,

        /** @var int $smoothness The smoothness of this Berry, used in making Pokéblocks or Poffins. */
        #[Field(FieldType::NUMBER)]
        public readonly int $smoothness,

        /** @var int $soilDryness The speed at which this Berry dries out the soil as it grows. A higher rate means the soil dries more quickly. */
        #[Field(FieldType::NUMBER, 'soil_dryness')]
        public readonly int $soilDryness,

        /** @var ProxyEndpoint<BerryFirmness>|BerryFirmness $firmness The firmness of this berry, used in making Pokéblocks or Poffins. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: BerryFirmness::class)]
        public readonly ProxyEndpoint|BerryFirmness $firmness,

        /** @var Collection<BerryFlavorMap> $flavors A list of references to each flavor a berry can have and the potency of each of those flavors in regard to this berry. */
        #[Field(FieldType::COLLECTION, definition: BerryFlavorMap::class)]
        public readonly Collection $flavors,

        /** @var ProxyEndpoint<Item>|Item $item Berries are actually items. This is a reference to the item specific data for this berry. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Item::class)]
        public readonly ProxyEndpoint|Item $item,

        /** @var ProxyEndpoint<Type>|Type $naturalGiftType The type inherited by "Natural Gift" when used with this Berry. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'natural_gift_type', definition: Type::class)]
        public readonly ProxyEndpoint|Type $naturalGiftType,
    ) {
    }
}
