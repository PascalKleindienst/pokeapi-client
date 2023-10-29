<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\Stat;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#movestatchange
 */
final readonly class MoveStatChange extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $change The amount of change. */
        #[Field(FieldType::NUMBER)]
        public int $change,

        /** @var ProxyEndpoint<Stat>|Stat $stat The stat being affected. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Stat::class)]
        public ProxyEndpoint|Stat $stat,
    ) {
    }
}
