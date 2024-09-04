<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Berries;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * Map between berry and flavor.
 *
 * Flavors determine whether a Pokémon will benefit or suffer from eating a berry based on their nature.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#berry-flavors
 */
final class FlavorBerryMap extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $potency How powerful the referenced flavor is for this berry. */
        #[Field(FieldType::NUMBER)]
        public int $potency,

        /** @var Berry $berry The berry with the referenced flavor. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Berry::class)]
        public Berry $berry,
    ) {
    }
}
