<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Targets moves can be directed at during battle. Targets can be Pokémon, environments or even other moves.
 *
 * @see https://pokeapi.co/docs/v2#movelearnmethod
 */
#[Endpoint(Resource::MOVE_TARGET)]
final readonly class MoveTarget extends Entity
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

        /** @var Collection<Move> $moves A list of moves that that are directed at this target. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Move::class)]
        public Collection $moves,

        /** @var Collection<Description> $descriptions The description of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
