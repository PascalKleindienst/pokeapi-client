<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Entities\Pokemon\Pokemon;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#itemholderpokemonversiondetail
 */
final readonly class ItemHolderPokemonVersionDetail extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $rarity How often this Pokémon holds this item in this version. */
        #[Field(FieldType::NUMBER)]
        public int $rarity,

        /** @var ProxyEndpoint<Version>|Version $version The version that this item is held in by the Pokémon. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public ProxyEndpoint|Version $version,
    ) {
    }
}
