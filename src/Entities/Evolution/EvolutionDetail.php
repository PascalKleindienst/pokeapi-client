<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Evolution;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Items\Item;
use PokeDB\PokeApiClient\Entities\Locations\Location;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Entities\Pokemon\Type;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#evolutiondetail
 */
final readonly class EvolutionDetail extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Item>|Item|null $item The item required to cause evolution this into Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Item::class)]
        public ProxyEndpoint|Item|null $item,

        /** @var ProxyEndpoint<EvolutionTrigger>|EvolutionTrigger $trigger The type of event that triggers evolution into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: EvolutionTrigger::class)]
        public ProxyEndpoint|EvolutionTrigger $trigger,

        /** @var int $gender The id of the gender of the evolving Pokémon species must be in order to evolve into this Pokémon species. */
        #[Field(FieldType::NUMBER)]
        public int $gender,

        /** @var ProxyEndpoint<Item>|Item|null $heldItem The item the evolving Pokémon species must be holding during the evolution trigger event to evolve into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'held_item', definition: Item::class)]
        public ProxyEndpoint|Item|null $heldItem,

        /** @var ProxyEndpoint<Move>|Move|null $knownMove The move that must be known by the evolving Pokémon species during the evolution trigger event in order to evolve into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'known_move', definition: Move::class)]
        public ProxyEndpoint|Move|null $knownMove,

        /** @var ProxyEndpoint<Type>|Type|null $knownMoveType The evolving Pokémon species must know a move with this type during the evolution trigger event in order to evolve into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'known_move_type', definition: Type::class)]
        public ProxyEndpoint|Type|null $knownMoveType,

        /** @var ProxyEndpoint<Location>|Location|null $location The location the evolution must be triggered at. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Location::class)]
        public ProxyEndpoint|Location|null $location,

        /** @var int $minLevel The minimum required level of the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NUMBER, apiName: 'min_level')]
        public int $minLevel,

        /** @var int $minHappiness The minimum required level of happiness the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NUMBER, apiName: 'min_happiness')]
        public int $minHappiness,

        /** @var int $minBeauty The minimum required level of beauty the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NUMBER, apiName: 'min_beauty')]
        public int $minBeauty,

        /** @var int $minAffection The minimum required level of affection the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NUMBER, apiName: 'min_affection')]
        public int $minAffection,

        /** @var bool $needsOverworldRain Whether or not it must be raining in the overworld to cause evolution this Pokémon species.. */
        #[Field(FieldType::BOOLEAN, apiName: 'needs_overworld_rain')]
        public bool $needsOverworldRain,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies|null $partySpecies The Pokémon species that must be in the players party in order for the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'party_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies|null $partySpecies,

        /** @var ProxyEndpoint<Type>|Type|null $partyType The player must have a Pokémon of this type in their party during the evolution trigger event in order for the evolving Pokémon species to evolve into this Pokémon species. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'party_type', definition: Type::class)]
        public ProxyEndpoint|Type|null $partyType,

        /** @var int $relativePhysicalStats The required relation between the Pokémon's Attack and Defense stats. 1 means Attack > Defense. 0 means Attack = Defense. -1 means Attack < Defense. */
        #[Field(FieldType::NUMBER, apiName: 'relative_physical_stats')]
        public int $relativePhysicalStats,

        /** @var ?string $timeOfDay The required time of day. Day or night. */
        #[Field(FieldType::STRING, apiName: 'time_of_day')]
        public ?string $timeOfDay,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies|null $tradeSpecies Pokémon species for which this one must be traded. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'trade_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies|null $tradeSpecies,

        /** @var bool $turnUpsideDown Whether or not the 3DS needs to be turned upside-down as this Pokémon levels up. */
        #[Field(FieldType::BOOLEAN, apiName: 'turn_upside_down')]
        public bool $turnUpsideDown,
    ) {
    }
}
