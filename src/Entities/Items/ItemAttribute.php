<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Item attributes define particular aspects of items, e.g. "usable in battle" or "consumable".
 *
 * @see https://pokeapi.co/docs/v2#itemattribute
 */
#[Endpoint(Resource::ITEM_ATTRIBUTE)]
final readonly class ItemAttribute extends Entity
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

        /** @var Collection<Item> $items A list of items that have this attribute. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Item::class)]
        public Collection $items,

        /** @var Collection<Description> $descriptions The description of this item attribute listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
