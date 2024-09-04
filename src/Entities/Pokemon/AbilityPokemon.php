<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#abilitypokemon
 */
final class AbilityPokemon extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var bool $isHidden Whether or not this a hidden ability for the referenced Pokémon. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_hidden')]
        public bool $isHidden,

        /** @var int $slot Pokémon have 3 ability 'slots' which hold references to possible abilities they could have. This is the slot of this ability for the referenced pokemon. */
        #[Field(FieldType::NUMBER)]
        public int $slot,

        /** @var Pokemon $pokemon The Pokémon this ability could belong to.. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public Pokemon $pokemon,
    ) {
    }
}
