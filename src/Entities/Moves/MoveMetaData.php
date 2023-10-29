<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#movemetadata
 */
final readonly class MoveMetaData extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<MoveAilment>|MoveAilment $ailment The status ailment this move inflicts on its target. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: MoveAilment::class)]
        public ProxyEndpoint|MoveAilment $ailment,

        /** @var ProxyEndpoint<MoveCategory>|MoveCategory $category The category of move this move falls under, e.g. damage or ailment. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: MoveCategory::class)]
        public ProxyEndpoint|MoveCategory $category,

        /** @var int $minHits The minimum number of times this move hits. Null if it always only hits once. */
        #[Field(FieldType::NUMBER, apiName: 'min_hits')]
        public int $minHits,

        /** @var int $maxHits The maximum number of times this move hits. Null if it always only hits once. */
        #[Field(FieldType::NUMBER, apiName: 'max_hits')]
        public int $maxHits,

        /** @var int $minTurns The minimum number of turns this move continues to take effect. Null if it always only lasts one turn. */
        #[Field(FieldType::NUMBER, apiName: 'min_turns')]
        public int $minTurns,

        /** @var int $maxTurns The maximum number of turns this move continues to take effect. Null if it always only lasts one turn. */
        #[Field(FieldType::NUMBER, apiName: 'max_turns')]
        public int $maxTurns,

        /** @var int $drain HP drain (if positive) or Recoil damage (if negative), in percent of damage done.. */
        #[Field(FieldType::NUMBER)]
        public int $drain,

        /** @var int $healing The amount of hp gained by the attacking Pokemon, in percent of it's maximum HP. */
        #[Field(FieldType::NUMBER)]
        public int $healing,

        /** @var int $critRate Critical hit rate bonus. */
        #[Field(FieldType::NUMBER, apiName: 'crit_rate')]
        public int $critRate,

        /** @var int $ailmentChance The likelihood this attack will cause an ailment. */
        #[Field(FieldType::NUMBER, apiName: 'ailment_chance')]
        public int $ailmentChance,

        /** @var int $flinchChance The likelihood this attack will cause the target Pokémon to flinch.. */
        #[Field(FieldType::NUMBER, apiName: 'flinch_chance')]
        public int $flinchChance,

        /** @var int $statChance The likelihood this attack will cause a stat change in the target Pokémon. */
        #[Field(FieldType::NUMBER, apiName: 'stat_chance')]
        public int $statChance,
    ) {
    }
}
