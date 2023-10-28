<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Contests;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Berries\BerryFlavor;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Contest types are categories judges used to weigh a Pokémon's condition in Pokémon contests.
 *
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#contest-types
 */
#[Endpoint(Resource::CONTEST_TYPE)]
final readonly class ContestType extends Entity
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

        /** @var ProxyEndpoint<BerryFlavor>|BerryFlavor $berryFlavor The berry flavor that correlates with this contest type. */
        #[Field(FieldType::NAMED_API_RESOURCE, 'berry_flavor', definition: BerryFlavor::class)]
        public ProxyEndpoint|BerryFlavor $berryFlavor,

        /** @var Collection<ContestName> $names The name of this contest type listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: ContestName::class)]
        public Collection $names,
    ) {
    }
}
