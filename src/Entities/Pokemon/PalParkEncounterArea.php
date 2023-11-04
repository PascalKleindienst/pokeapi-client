<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Locations\PalParkArea;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#palparkencounterarea
 */
final readonly class PalParkEncounterArea extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $baseScore The base score given to the player when the referenced Pokémon is caught during a pal park run. */
        #[Field(FieldType::NUMBER, apiName: 'base_score')]
        public int $baseScore,

        /** @var int $rate The base rate for encountering the referenced Pokémon in this pal park area. */
        #[Field(FieldType::NUMBER)]
        public int $rate,

        /** @var ProxyEndpoint<PalParkArea>|PalParkArea $area The pal park area where this encounter happens. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PalParkArea::class)]
        public ProxyEndpoint|PalParkArea $area,
    ) {
    }
}
