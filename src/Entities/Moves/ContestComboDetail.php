<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#contestcombodetail
 */
final readonly class ContestComboDetail extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Move>|Move $useBefore A list of moves to use before this move. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'use_before', definition: Move::class)]
        public ProxyEndpoint|Move $useBefore,

        /** @var ProxyEndpoint<Move>|Move $useAfter A list of moves to use after this move. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'use_after', definition: Move::class)]
        public ProxyEndpoint|Move $useAfter,
    ) {
    }
}
