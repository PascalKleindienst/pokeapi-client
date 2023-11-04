<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonability
 */
final readonly class PokemonAbility extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var bool $isHidden Whether or not this is a hidden ability. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_hidden')]
        public bool $isHidden,

        /** @var int $slot The slot this ability occupies in this Pokémon species. */
        #[Field(FieldType::NUMBER)]
        public int $slot,

        /** @var ProxyEndpoint<Ability>|Ability $ability The ability the Pokémon may have. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Ability::class)]
        public ProxyEndpoint|Ability $ability,
    ) {
    }
}
