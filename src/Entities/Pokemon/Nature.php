<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Berries\BerryFlavor;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Natures influence how a Pokémon's stats grow. See Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#natures
 */
#[Endpoint(Resource::NATURE)]
final readonly class Nature extends Entity
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

        /** @var ProxyEndpoint<Stat>|Stat $decreasedStat The stat decreased by 10% in Pokémon with this nature. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'decreased_stat', definition: Stat::class)]
        public ProxyEndpoint|Stat $decreasedStat,

        /** @var ProxyEndpoint<Stat>|Stat $increasedStat The stat increased by 10% in Pokémon with this nature. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'increased_stat', definition: Stat::class)]
        public ProxyEndpoint|Stat $increasedStat,

        /** @var ProxyEndpoint<BerryFlavor>|BerryFlavor $hatesFlavor The flavor hated by Pokémon with this nature. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'hates_flavor', definition: BerryFlavor::class)]
        public ProxyEndpoint|BerryFlavor $hatesFlavor,

        /** @var ProxyEndpoint<BerryFlavor>|BerryFlavor $likesFlavorflavor The flavor liked by Pokémon with this nature. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'likes_flavor', definition: BerryFlavor::class)]
        public ProxyEndpoint|BerryFlavor $likesFlavor,

        /** @var Collection<NatureStatChange> $pokeathlonStatChanges A list of Pokéathlon stats this nature effects and how much it effects them. */
        #[Field(FieldType::COLLECTION, apiName: 'pokeathlon_stat_changes', definition: NatureStatChange::class)]
        public Collection $pokeathlonStatChanges,

        /** @var Collection<MoveBattleStylePreference> $moveBattleStylePreferences A list of battle styles and how likely a Pokémon with this nature is to use them in the Battle Palace or Battle Tent. */
        #[Field(FieldType::COLLECTION, apiName: 'move_battle_style_preferences', definition: MoveBattleStylePreference::class)]
        public Collection $moveBattleStylePreferences,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
