<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#naturestatchange
 */
final class NatureStatChange extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $maxChange The amount of change. */
        #[Field(FieldType::NUMBER, apiName: 'max_change')]
        public int $maxChange,

        /** @var PokeathlonStat $pokeathlonStat The stat being affected. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokeathlon_stat', definition: PokeathlonStat::class)]
        public PokeathlonStat $pokeathlonStat,
    ) {
    }
}
