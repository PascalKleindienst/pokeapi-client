<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#typerelationspast
 */
final class TypeRelationsPast extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Generation $generation The last generation in which the referenced type had the listed damage relations */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public Generation $generation,

        /** @var TypeRelations $damageRelations The damage relations the referenced type had up to and including the listed generation. */
        #[Field(FieldType::ENTITY, apiName: 'damage_relations', definition: TypeRelations::class)]
        public TypeRelations $damageRelations,
    ) {
    }
}
