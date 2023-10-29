<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Effect;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * The various effects of the move "Fling" when used with different items.
 *
 * @see https://pokeapi.co/docs/v2#itemflingeffect
 */
#[Endpoint(Resource::ITEM_FLING_EFFECT)]
final readonly class ItemFlingEffect extends Entity
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

        /** @var Collection<Item> $items A list of items that have this fling effect. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Item::class)]
        public Collection $items,

        /** @var Collection<Collection<Effect>> $effectEntries The result of this fling effect listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: Effect::class)]
        public Collection $effectEntries,
    ) {
    }
}
