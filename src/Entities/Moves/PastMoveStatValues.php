<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Pokemon\Type;
use PokeDB\PokeApiClient\Entities\Utility\VerboseEffect;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pastmovestatvalues
 */
final readonly class PastMoveStatValues extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $accuracy The percent value of how likely this move is to be successful. */
        #[Field(FieldType::NUMBER)]
        public int $accuracy,

        /** @var int $effectChance The percent value of how likely it is this moves effect will take effect.. */
        #[Field(FieldType::NUMBER, apiName: 'effect_chance')]
        public int $effectChance,

        /** @var int $power The base power of this move with a value of 0 if it does not have a base power. */
        #[Field(FieldType::NUMBER)]
        public int $power,

        /** @var int $pp Power points. The number of times this move can be used. */
        #[Field(FieldType::NUMBER)]
        public int $pp,

        /** @var Collection<VerboseEffect> $effectEntries The effect of this move listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: VerboseEffect::class)]
        public Collection $effectEntries,

        /** @var ProxyEndpoint<Type>|Type $type The elemental type of this move. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Type::class)]
        public ProxyEndpoint|Type $type,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group in which these move stat values were in effect. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,
    ) {
    }
}
