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
 * Methods by which the player might can encounter Pokémon in the wild, e.g., walking in tall grass.
 *
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#encounter-methods
 */
#[Endpoint(Resource::ENCOUNTER_METHOD)]
final readonly class EncounterMethod extends Entity
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

        /** @var int $order A good value for sorting. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var Collection<Collection<Name>> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
