<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Utility\Effect;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#abilityeffectchange
 */
final readonly class AbilityEffectChange extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Collection<Collection<Effect>> $effectEntries The previous effect of this ability listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: Effect::class)]
        public Collection $effectEntries,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group in which the previous effect of this ability originated. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,
    ) {
    }
}
