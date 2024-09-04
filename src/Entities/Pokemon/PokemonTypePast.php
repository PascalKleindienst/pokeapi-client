<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemontypepast
 */
final class PokemonTypePast extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Generation $generation The last generation in which the referenced pokémon had the listed types. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public Generation $generation,

        /** @var Collection<PokemonType> $types The types the referenced pokémon had up to and including the listed generation.. */
        #[Field(FieldType::COLLECTION, definition: PokemonType::class)]
        public Collection $types,
    ) {
    }
}
