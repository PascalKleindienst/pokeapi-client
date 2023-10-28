<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Encounters\EncounterMethod;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#encountermethodrate
 */
final readonly class EncounterMethodRate extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<EncounterMethod>|EncounterMethod $encounterMethod The method in which Pokémon may be encountered in an area. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'encounter_method', definition: EncounterMethod::class)]
        public ProxyEndpoint|EncounterMethod $encounterMethod,

        /** @var Collection<EncounterVersionDetails> $versionDetails The chance of the encounter to occur on a version of the game. */
        #[Field(FieldType::COLLECTION, apiName: 'version_details', definition: EncounterVersionDetails::class)]
        public Collection $versionDetails,
    ) {
    }
}
