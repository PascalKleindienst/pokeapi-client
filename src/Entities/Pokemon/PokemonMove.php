<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemonmove
 */
final class PokemonMove extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Move $move The move the Pokémon can learn. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Move::class)]
        public Move $move,

        /** @var Collection<PokemonMoveVersion> $versionGroupDetails The details of the version in which the Pokémon can learn the move. */
        #[Field(FieldType::COLLECTION, apiName: 'version_group_details', definition: PokemonMoveVersion::class)]
        public Collection $versionGroupDetails,
    ) {
    }
}
