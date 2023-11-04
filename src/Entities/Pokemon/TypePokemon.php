<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#typepokemon
 */
final readonly class TypePokemon extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $slot The order the Pokémon's types are listed in. */
        #[Field(FieldType::NUMBER)]
        public int $slot,

        /** @var ProxyEndpoint<Pokemon>|Pokemon $pokemon The Pokémon that has the referenced type. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public ProxyEndpoint|Pokemon $pokemon,
    ) {
    }
}
