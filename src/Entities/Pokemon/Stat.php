<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Moves\MoveDamageClass;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Stats determine certain aspects of battles.
 *
 * Each Pokémon has a value for each stat which grows as they gain levels and can be altered
 * momentarily by effects in battles.
 *
 * @see https://pokeapi.co/docs/v2#stat
 */
#[Endpoint(Resource::STAT)]
final readonly class Stat extends Entity
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

        /** @var int $gameIndex ID the games use for this stat. */
        #[Field(FieldType::NUMBER, apiName: 'game_index')]
        public int $gameIndex,

        /** @var bool $isBattleOnly Whether this stat only exists within a battle. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_battle_only')]
        public bool $isBattleOnly,

        /** @var MoveStatAffectSets $affectingMoves A detail of moves which affect this stat positively or negatively. */
        #[Field(FieldType::ENTITY, apiName: 'affecting_moves', definition: MoveStatAffectSets::class)]
        public MoveStatAffectSets $affectingMoves,

        /** @var NatureStatAffectSets $affectingNatures A detail of natures which affect this stat positively or negatively. */
        #[Field(FieldType::ENTITY, apiName: 'affecting_natures', definition: NatureStatAffectSets::class)]
        public NatureStatAffectSets $affectingNatures,

        /** @var Collection<Characteristic> $characteristics A list of characteristics that are set on a Pokémon when its highest base stat is this stat. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Characteristic::class)]
        public Collection $characteristics,

        /** @var ProxyEndpoint<MoveDamageClass>|MoveDamageClass $moveDamageClass The class of damage this stat is directly related to. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'move_damage_class', definition: MoveDamageClass::class)]
        public ProxyEndpoint|MoveDamageClass $moveDamageClass,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
