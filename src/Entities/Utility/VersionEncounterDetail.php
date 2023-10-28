<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#versionencounterdetail
 */
final readonly class VersionEncounterDetail extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $maxChance The total percentage of all encounter potential. */
        #[Field(FieldType::NUMBER, apiName: 'max_chance')]
        public int $maxChance,

        /** @var Collection<Encounter> $encounterDetails A list of encounters and their specifics. */
        #[Field(FieldType::COLLECTION, apiName: 'encounter_details')]
        public Collection $encounterDetails,

        /** @var ProxyEndpoint<Version>|Version $version The game version this encounter happens in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public ProxyEndpoint|Version $version,
    ) {
    }
}
