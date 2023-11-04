<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#movestataffect
 */
final readonly class MoveStatAffect extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $change The maximum amount of change to the referenced stat.. */
        #[Field(FieldType::NUMBER)]
        public int $change,

        /** @var ProxyEndpoint<Move>|Move $move The move causing the change. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Move::class)]
        public ProxyEndpoint|Move $move,
    ) {
    }
}
