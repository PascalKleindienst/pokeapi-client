<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Entities\Encounters\EncounterConditionValue;
use PokeDB\PokeApiClient\Entities\Encounters\EncounterMethod;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#encounter
 */
final class Encounter extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $minLevel The lowest level the Pokémon could be encountered at. */
        #[Field(FieldType::NUMBER, apiName: 'min_level')]
        public int $minLevel,

        /** @var int $maxLevel The highest level the Pokémon could be encountered at. */
        #[Field(FieldType::NUMBER, apiName: 'max_level')]
        public int $maxLevel,

        /** @var int $chance Percent chance that this encounter will occur. */
        #[Field(FieldType::NUMBER)]
        public int $chance,

        /** @var ApiResourceCollection<EncounterConditionValue> $conditionValues A list of condition values that must be in effect for this encounter to occur. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: EncounterConditionValue::class)]
        public ApiResourceCollection $conditionValues,

        /** @var EncounterMethod $method The method by which this encounter happens. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: EncounterMethod::class)]
        public EncounterMethod $method,
    ) {
    }
}
