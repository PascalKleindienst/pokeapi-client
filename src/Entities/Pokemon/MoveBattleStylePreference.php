<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Moves\MoveBattleStyle;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#movebattlestylepreference
 */
final readonly class MoveBattleStylePreference extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $lowHpPreference Chance of using the move, in percent, if HP is under one half. */
        #[Field(FieldType::NUMBER, apiName: 'low_hp_preference')]
        public int $lowHpPreference,

        /** @var int $highHpPreference Chance of using the move, in percent, if HP is over one half. */
        #[Field(FieldType::NUMBER, apiName: 'high_hp_preference')]
        public int $highHpPreference,

        /** @var ProxyEndpoint<MoveBattleStyle>|MoveBattleStyle $moveBattleStyle The move battle style. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'move_battle_style', definition: MoveBattleStyle::class)]
        public ProxyEndpoint|MoveBattleStyle $moveBattleStyle,
    ) {
    }
}
