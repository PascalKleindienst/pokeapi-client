<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Berries;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Berries can be soft or hard.
 *
 * @see https://pokeapi.co/docs/v2#berry-firmnesses
 */
#[Endpoint(Resource::BERRY_FIRMNESS)]
class BerryFirmness extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public readonly int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public readonly string $name,

        /** @var Collection<Berry> $berries A list of the berries with this firmness. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Berry::class)]
        public readonly Collection $berries,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'name')]
        public readonly Collection $names,
    ) {
    }
}
