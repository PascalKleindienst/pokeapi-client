<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Areas used for grouping Pokémon encounters in Pal Park. They're like habitats that are specific to Pal Park.
 *
 * @see https://pokeapi.co/docs/v2#pal-park-areas
 */
#[Endpoint(Resource::PAL_PARK_AREA)]
final readonly class PalParkArea extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var Collection<PalParkEncounterSpecies> $pokemonEncounters A list of Pokémon encountered in thi pal park area along with details. */
        #[Field(FieldType::COLLECTION, definition: PalParkEncounterSpecies::class)]
        public Collection $pokemonEncounters,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
