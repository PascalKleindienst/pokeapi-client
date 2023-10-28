<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#itemsprites
 */
final readonly class ItemSprites extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $default The default depiction of this item. */
        #[Field(FieldType::STRING)]
        public string $default,
    ) {
    }
}
