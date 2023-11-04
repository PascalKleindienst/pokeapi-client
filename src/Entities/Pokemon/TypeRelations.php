<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#typerelations
 */
final readonly class TypeRelations extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<Type> $noDamageTo A list of types this type has no effect on. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'no_damage_to', definition: Type::class)]
        public Collection $noDamageTo,

        /** @var Collection<Type> $halfDamageTo A list of types this type is not very effect against. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'half_damage_to', definition: Type::class)]
        public Collection $halfDamageTo,

        /** @var Collection<Type> $doubleDamageTo A list of types this type is very effect against. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'double_damage_to', definition: Type::class)]
        public Collection $doubleDamageTo,

        /** @var Collection<Type> $noDamageFrom A list of types that have no effect on this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'no_damage_from', definition: Type::class)]
        public Collection $noDamageFrom,

        /** @var Collection<Type> $halfDamageFrom A list of types that are not very effective against this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'half_damage_from', definition: Type::class)]
        public Collection $halfDamageFrom,

        /** @var Collection<Type> $doubleDamageFrom A list of types that are very effective against this type. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'double_damage_from', definition: Type::class)]
        public Collection $doubleDamageFrom,
    ) {
    }
}
