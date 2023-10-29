<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#contestcombosets
 */
final readonly class ContestComboSets extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ContestComboDetail $normal A detail of moves this move can be used before or after, granting additional appeal points in contests. */
        #[Field(FieldType::ENTITY, definition: ContestComboDetail::class)]
        public ContestComboDetail $normal,

        /** @var ContestComboDetail $super A detail of moves this move can be used before or after, granting additional appeal points in super contests. */
        #[Field(FieldType::ENTITY, definition: ContestComboDetail::class)]
        public ContestComboDetail $super,
    ) {
    }
}
