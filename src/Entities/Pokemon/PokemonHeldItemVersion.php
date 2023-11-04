<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonhelditemversion
 */
final readonly class PokemonHeldItemVersion extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Version>|Version $version The version in which the item is held. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public ProxyEndpoint|Version $version,

        /** @var int $rarity How often the item is held. */
        #[Field(FieldType::NUMBER)]
        public int $rarity,
    ) {
    }
}
