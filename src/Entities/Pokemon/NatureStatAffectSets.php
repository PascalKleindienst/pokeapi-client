<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#naturestataffectsets
 */
final readonly class NatureStatAffectSets extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<Nature> $increase A list of natures and how they change the referenced stat.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Nature::class)]
        public Collection $increase,

        /** @var Collection<Nature> $decrease A list of nature sand how they change the referenced stat. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Nature::class)]
        public Collection $decrease,
    ) {
    }
}
