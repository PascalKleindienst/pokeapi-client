<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Encounters;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Conditions which affect what pokemon might appear in the wild, e.g., day or night.
 *
 * @see https://pokeapi.co/docs/v2#encounter-conditions
 */
#[Endpoint(Resource::ENCOUNTER_CONDITION)]
final readonly class EncounterCondition extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var Collection<EncounterConditionValue> $values A list of possible values for this encounter condition. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: EncounterConditionValue::class)]
        public Collection $values,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
