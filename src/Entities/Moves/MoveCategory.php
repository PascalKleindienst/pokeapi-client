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
 * Very general categories that loosely group move effects.
 *
 * @see https://pokeapi.co/docs/v2#movecategory
 */
#[Endpoint(Resource::MOVE_CATEGORY)]
final readonly class MoveCategory extends Entity
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

        /** @var Collection<Move> $moves A list of moves that cause this ailment. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Move::class)]
        public Collection $moves,

        /** @var Collection<Collection<Description>> $descriptions The description of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,
    ) {
    }
}
