<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Contests\ContestEffect;
use PokeDB\PokeApiClient\Entities\Contests\ContestType;
use PokeDB\PokeApiClient\Entities\Contests\SuperContestEffect;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Entities\Pokemon\AbilityEffectChange;
use PokeDB\PokeApiClient\Entities\Pokemon\Pokemon;
use PokeDB\PokeApiClient\Entities\Pokemon\Type;
use PokeDB\PokeApiClient\Entities\Utility\MachineVersionDetail;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Entities\Utility\VerboseEffect;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Moves are the skills of Pokémon in battle. In battle, a Pokémon uses one move each turn.
 * Some moves (including those learned by Hidden Machine) can be used outside of battle as well,
 * usually for the purpose of removing obstacles or exploring new areas.
 *
 * @see https://pokeapi.co/docs/v2#move
 */
#[Endpoint(Resource::MOVE)]
final readonly class Move extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var int $accuracy The percent value of how likely this move is to be successful. */
        #[Field(FieldType::NUMBER)]
        public int $accuracy,

        /** @var int $effectChance The percent value of how likely it is this moves effect will happen. */
        #[Field(FieldType::NUMBER, apiName: 'effect_chance')]
        public int $effectChance,

        /** @var int $pp A value between -8 and 8. Sets the order in which moves are executed during battle. See Bulbapedia for greater detail. */
        #[Field(FieldType::NUMBER)]
        public int $pp,

        /** @var int $priority The base power of this move with a value of 0 if it does not have a base power.e */
        #[Field(FieldType::NUMBER)]
        public int $priority,

        /** @var int $power The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $power,

        /** @var ContestComboSets $contestCombo A detail of normal and super contest combos that require this move. */
        #[Field(FieldType::ENTITY, apiName: 'contest_combo', definition: ContestComboSets::class)]
        public ContestComboSets $contestCombo,

        /** @var ProxyEndpoint<ContestEffect>|ContestType $contestType The type of appeal this move gives a Pokémon when used in a contest. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'contest_type', definition: ContestType::class)]
        public ProxyEndpoint|ContestType $contestType,

        /** @var ProxyEndpoint<ContestEffect>|ContestEffect $contestEffect The effect the move has when used in a contest. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'contest_effect', definition: ContestEffect::class)]
        public ProxyEndpoint|ContestEffect $contestEffect,

        /** @var ProxyEndpoint<MoveDamageClass>|MoveDamageClass $damageClass The type of damage the move inflicts on the target, e.g. physical. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'damage_class', definition: MoveDamageClass::class)]
        public ProxyEndpoint|MoveDamageClass $damageClass,

        /** @var Collection<VerboseEffect> $effectEntries The effect of this move listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: VerboseEffect::class)]
        public Collection $effectEntries,

        /** @var Collection<AbilityEffectChange> $effectChanges The list of previous effects this move has had across version groups of the games. */
        #[Field(FieldType::COLLECTION, apiName: 'effect_changes', definition: AbilityEffectChange::class)]
        public Collection $effectChanges,

        /** @var Collection<Pokemon> $learnedByPokemon List of Pokemon that can learn the move. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'learned_by_pokemon', definition: Pokemon::class)]
        public Collection $learnedByPokemon,

        /** @var Collection<MoveFlavorText> $flavorTextEntries The flavor text of this move listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'flavor_text_entries', definition: MoveFlavorText::class)]
        public Collection $flavorTextEntries,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation in which this move was introduced. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,

        /** @var Collection<MachineVersionDetail> $machines The list of previous effects this move has had across version groups of the games. */
        #[Field(FieldType::COLLECTION, definition: MachineVersionDetail::class)]
        public Collection $machines,

        /** @var MoveMetaData $meta Metadata about this move */
        #[Field(FieldType::ENTITY, definition: MoveMetaData::class)]
        public MoveMetaData $meta,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<PastMoveStatValues> $pastValues A list of move resource value changes across version groups of the game. */
        #[Field(FieldType::COLLECTION, apiName: 'past_values', definition: PastMoveStatValues::class)]
        public Collection $pastValues,

        /** @var Collection<MoveStatChange> $statChanges A list of stats this moves effects and how much it effects them. */
        #[Field(FieldType::COLLECTION, apiName: 'stat_changes', definition: MoveStatChange::class)]
        public Collection $statChanges,

        /** @var ProxyEndpoint<SuperContestEffect>|SuperContestEffect $superContestEffect The effect the move has when used in a super contest. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'super_contest_effect', definition: SuperContestEffect::class)]
        public ProxyEndpoint|SuperContestEffect $superContestEffect,

        /** @var ProxyEndpoint<MoveTarget>|MoveTarget $target The type of target that will receive the effects of the attack. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: MoveTarget::class)]
        public ProxyEndpoint|MoveTarget $target,

        /** @var ProxyEndpoint<Type>|Type $type The elemental type of this move. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Type::class)]
        public ProxyEndpoint|Type $type,
    ) {
    }
}
