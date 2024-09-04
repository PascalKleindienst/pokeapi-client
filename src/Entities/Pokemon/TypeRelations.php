<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;

/**
 * @see https://pokeapi.co/docs/v2#typerelations
 */
final class TypeRelations extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ApiResourceCollection<Type> $noDamageTo A list of types this type has no effect on. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'no_damage_to', definition: Type::class)]
        public ApiResourceCollection $noDamageTo,

        /** @var ApiResourceCollection<Type> $halfDamageTo A list of types this type is not very effect against. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'half_damage_to', definition: Type::class)]
        public ApiResourceCollection $halfDamageTo,

        /** @var ApiResourceCollection<Type> $doubleDamageTo A list of types this type is very effect against. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'double_damage_to', definition: Type::class)]
        public ApiResourceCollection $doubleDamageTo,

        /** @var ApiResourceCollection<Type> $noDamageFrom A list of types that have no effect on this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'no_damage_from', definition: Type::class)]
        public ApiResourceCollection $noDamageFrom,

        /** @var ApiResourceCollection<Type> $halfDamageFrom A list of types that are not very effective against this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'half_damage_from', definition: Type::class)]
        public ApiResourceCollection $halfDamageFrom,

        /** @var ApiResourceCollection<Type> $doubleDamageFrom A list of types that are very effective against this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'double_damage_from', definition: Type::class)]
        public ApiResourceCollection $doubleDamageFrom,
    ) {
    }
}
