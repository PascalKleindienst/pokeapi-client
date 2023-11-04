<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#versiongameindex
 */
final readonly class VersionGameIndex extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $gameIndex The internal id of an API resource within game data. */
        #[Field(FieldType::NUMBER, apiName: 'game_index')]
        public int $gameIndex,

        /** @var ProxyEndpoint<Version>|Version $generation The version relevent to this game index. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public ProxyEndpoint|Version $generation,
    ) {
    }
}
