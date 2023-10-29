<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Styles of moves when used in the Battle Palace. See Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#move-battle-styles
 */
#[Endpoint(Resource::MOVE_BATTLE_STYLE)]
final readonly class MoveBattleStyle extends Entity
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

        /** @var Collection<Collection<Name>> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
