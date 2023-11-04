<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#movestataffectsets
 */
final readonly class MoveStatAffectSets extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<MoveStatAffect> $increase A list of moves and how they change the referenced stat. */
        #[Field(FieldType::COLLECTION, definition: MoveStatAffect::class)]
        public Collection $increase,

        /** @var Collection<MoveStatAffect> $decrease A list of moves and how they change the referenced stat. */
        #[Field(FieldType::COLLECTION, definition: MoveStatAffect::class)]
        public Collection $decrease,
    ) {
    }
}
