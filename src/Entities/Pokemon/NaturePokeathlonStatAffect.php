<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#naturepokeathlonstataffect
 */
final readonly class NaturePokeathlonStatAffect extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $maxChange The maximum amount of change to the referenced Pokéathlon stat.. */
        #[Field(FieldType::NUMBER, apiName: 'max_change')]
        public int $maxChange,

        /** @var ProxyEndpoint<Nature>|Nature $nature The nature causing the change. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Nature::class)]
        public ProxyEndpoint|Nature $nature,
    ) {
    }
}
