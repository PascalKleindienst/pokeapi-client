<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#naturepokeathlonstataffectsets
 */
final readonly class NaturePokeathlonStatAffectSets extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<NaturePokeathlonStatAffect> $increase A list of natures and how they change the referenced Pokéathlon stat. */
        #[Field(FieldType::COLLECTION, definition: NaturePokeathlonStatAffect::class)]
        public Collection $increase,

        /** @var Collection<NaturePokeathlonStatAffect> $decrease A list of natures and how they change the referenced Pokéathlon stat. */
        #[Field(FieldType::COLLECTION, definition: NaturePokeathlonStatAffect::class)]
        public Collection $decrease,
    ) {
    }
}
