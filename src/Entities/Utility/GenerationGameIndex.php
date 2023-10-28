<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#generationgameindex
 */
final readonly class GenerationGameIndex extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $gameIndex The internal id of an API resource within game data. */
        #[Field(FieldType::NUMBER, apiName: 'game_index')]
        public int $gameIndex,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation relevent to this game index.. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,
    ) {
    }
}
