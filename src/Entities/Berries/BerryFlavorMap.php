<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Berries;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
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
class BerryFlavorMap extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $potency How powerful the referenced flavor is for this berry. */
        #[Field(FieldType::NUMBER)]
        public int $potency,

        /** @var ProxyEndpoint<BerryFlavor>|BerryFlavor $flavor The referenced berry flavor. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: BerryFlavor::class)]
        public ProxyEndpoint|BerryFlavor $flavor,
    ) {
    }
}
