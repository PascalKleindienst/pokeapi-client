<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#palparkencounterarea
 */
final class PokemonSpeciesVariety extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var bool $isDefault Whether this variety is the default variety. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_default')]
        public bool $isDefault,

        /** @var Pokemon $pokemon The Pokémon variety. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public Pokemon $pokemon,
    ) {
    }
}
