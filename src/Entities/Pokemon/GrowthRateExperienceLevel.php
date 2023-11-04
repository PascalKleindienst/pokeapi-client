<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#growthrateexperiencelevel
 */
final readonly class GrowthRateExperienceLevel extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $level The level gained. */
        #[Field(FieldType::NUMBER)]
        public int $level,

        /** @var int $experience The amount of experience required to reach the referenced level. */
        #[Field(FieldType::NUMBER)]
        public int $experience,
    ) {
    }
}
