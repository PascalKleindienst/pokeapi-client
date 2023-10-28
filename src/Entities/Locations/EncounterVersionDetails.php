<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#encountermethodrate
 */
final readonly class EncounterVersionDetails extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $rate The chance of an encounter to occur.. */
        #[Field(FieldType::NUMBER)]
        public int $rate,

        /** @var ProxyEndpoint<Version>|Version $version The version of the game in which the encounter can occur with the given chance. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public ProxyEndpoint|Version $version,
    ) {
    }
}
