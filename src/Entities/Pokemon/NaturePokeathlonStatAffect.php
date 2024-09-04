<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#naturepokeathlonstataffect
 */
final class NaturePokeathlonStatAffect extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $maxChange The maximum amount of change to the referenced Pokéathlon stat.. */
        #[Field(FieldType::NUMBER, apiName: 'max_change')]
        public int $maxChange,

        /** @var Nature $nature The nature causing the change. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Nature::class)]
        public Nature $nature,
    ) {
    }
}
