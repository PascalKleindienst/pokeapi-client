<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Entities\Utility\VerboseEffect;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Abilities provide passive effects for Pokémon in battle or in the overworld.
 * Pokémon have multiple possible abilities but can have only one ability at a time.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#ability
 */
#[Endpoint(Resource::ABILITY)]
final readonly class Ability extends Entity
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

        /** @var bool $isMainSeries Whether or not this ability originated in the main series of the video games. */
        #[Field(FieldType::BOOLEAN)]
        public bool $isMainSeries,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation this ability originated in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<VerboseEffect> $effectEntries The effect of this ability listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: VerboseEffect::class)]
        public Collection $effectEntries,

        /** @var Collection<AbilityEffectChange> $effectChanges The list of previous effects this ability has had across version groups. */
        #[Field(FieldType::COLLECTION, apiName: 'effect_changes', definition: AbilityEffectChange::class)]
        public Collection $effectChanges,

        /** @var Collection<AbilityFlavorText> $flavorTextEntries The flavor text of this ability listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'flavor_text_entries', definition: AbilityFlavorText::class)]
        public Collection $flavorTextEntries,

        /** @var Collection<AbilityPokemon> $pokemon A list of Pokémon that could potentially have this ability. */
        #[Field(FieldType::COLLECTION, definition: AbilityPokemon::class)]
        public Collection $pokemon,
    ) {
    }
}
