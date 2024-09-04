<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;

/**
 * @see https://pokeapi.co/docs/v2#naturestataffectsets
 */
final class NatureStatAffectSets extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ApiResourceCollection<Nature> $increase A list of natures and how they change the referenced stat.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Nature::class)]
        public ApiResourceCollection $increase,

        /** @var ApiResourceCollection<Nature> $decrease A list of nature sand how they change the referenced stat. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Nature::class)]
        public ApiResourceCollection $decrease,
    ) {
    }
}
