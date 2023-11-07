<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Evolution\EvolutionChain;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\FlavorText;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * A Pokémon Species forms the basis for at least one Pokémon.
 *
 * Attributes of a Pokémon species are shared across all varieties of Pokémon within the species.
 * A good example is Wormadam; Wormadam is the species which can be found in three different varieties,
 * Wormadam-Trash, Wormadam-Sandy and Wormadam-Plant.
 *
 * @see https://pokeapi.co/docs/v2#pokemonspecies
 */
#[Endpoint(Resource::POKEMON_SPECIES)]
final readonly class PokemonSpecies extends Entity
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

        /** @var int $order The order in which species should be sorted. Based on National Dex order, except families are grouped together and sorted by stage. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var int $genderRate The chance of this Pokémon being female, in eighths; or -1 for genderless. */
        #[Field(FieldType::NUMBER, apiName: 'gender_rate')]
        public int $genderRate,

        /** @var int $captureRate The base capture rate; up to 255. The higher the number, the easier the catch. */
        #[Field(FieldType::NUMBER, apiName: 'capture_rate')]
        public int $captureRate,

        /** @var int $baseHappiness The happiness when caught by a normal Pokéball; up to 255. The higher the number, the happier the Pokémon. */
        #[Field(FieldType::NUMBER, apiName: 'base_happiness')]
        public int $baseHappiness,

        /** @var bool $isBaby Whether or not this is a baby Pokémon. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_baby')]
        public bool $isBaby,

        /** @var bool $isLegendary Whether or not this is a legendary Pokémon. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_legendary')]
        public bool $isLegendary,

        /** @var bool $isMythical Whether or not this is a mythical Pokémon. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_mythical')]
        public bool $isMythical,

        /** @var int $hatchCounter Initial hatch counter: one must walk 255 × (hatch_counter + 1) steps before this Pokémon's egg hatches, unless utilizing bonuses like Flame Body's. */
        #[Field(FieldType::NUMBER, apiName: 'hatch_counter')]
        public int $hatchCounter,

        /** @var bool $hasGenderDifferences Whether or not this Pokémon has visual gender differences. */
        #[Field(FieldType::BOOLEAN, apiName: 'has_gender_differences')]
        public bool $hasGenderDifferences,

        /** @var bool $formsSwitchable Whether or not this Pokémon has multiple forms and can switch between them. */
        #[Field(FieldType::BOOLEAN, apiName: 'forms_switchable')]
        public bool $formsSwitchable,

        /** @var ProxyEndpoint<GrowthRate>|GrowthRate $growthRate The rate at which this Pokémon species gains levels. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'growth_rate', definition: GrowthRate::class)]
        public ProxyEndpoint|GrowthRate $growthRate,

        /** @var Collection<PokemonSpeciesDexEntry> $pokedexNumbers A list of Pokedexes and the indexes reserved within them for this Pokémon species. */
        #[Field(FieldType::COLLECTION, apiName: 'pokedex_numbers', definition: PokemonSpeciesDexEntry::class)]
        public Collection $pokedexNumbers,

        /** @var Collection<EggGroup> $eggGroups A list of egg groups this Pokémon species is a member of. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'egg_groups', definition: EggGroup::class)]
        public Collection $eggGroups,

        /** @var ProxyEndpoint<PokemonColor>|PokemonColor $color The color of this Pokémon for Pokédex search. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PokemonColor::class)]
        public ProxyEndpoint|PokemonColor $color,

        /** @var ProxyEndpoint<PokemonShape>|PokemonShape|null $shape The shape of this Pokémon for Pokédex search. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PokemonShape::class)]
        public ProxyEndpoint|PokemonShape|null $shape,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies|null $evolvesFromSpecies The Pokémon species that evolves into this Pokemon_species.  */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'evolves_from_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies|null $evolvesFromSpecies,

        /** @var ProxyEndpoint<EvolutionChain>|EvolutionChain $evolutionChain The evolution chain this Pokémon species is a member of..  */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'evolution_chain', definition: EvolutionChain::class)]
        public ProxyEndpoint|EvolutionChain $evolutionChain,

        /** @var ProxyEndpoint<PokemonHabitat>|PokemonHabitat|null $habitat The habitat this Pokémon species can be encountered in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PokemonHabitat::class)]
        public ProxyEndpoint|PokemonHabitat|null $habitat,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation this Pokémon species was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<PalParkEncounterArea> $palParkEncounters A list of encounters that can be had with this Pokémon species in pal park. */
        #[Field(FieldType::COLLECTION, apiName: 'pal_park_encounters', definition: PalParkEncounterArea::class)]
        public Collection $palParkEncounters,

        /** @var Collection<FlavorText> $flavorTextEntries A list of flavor text entries for this Pokémon species. */
        #[Field(FieldType::TRANSLATION, apiName: 'flavor_text_entries', definition: FlavorText::class)]
        public Collection $flavorTextEntries,

        /** @var Collection<Description> $formDescriptions Descriptions of different forms Pokémon take on within the Pokémon species. */
        #[Field(FieldType::TRANSLATION, apiName: 'form_descriptions', definition: Description::class)]
        public Collection $formDescriptions,

        /** @var Collection<Genus> $genera The genus of this Pokémon species listed in multiple languages. */
        #[Field(FieldType::TRANSLATION, definition: Genus::class)]
        public Collection $genera,

        /** @var Collection<PokemonSpeciesVariety> $varieties A list of the Pokémon that exist within this Pokémon species. */
        #[Field(FieldType::COLLECTION, definition: PokemonSpeciesVariety::class)]
        public Collection $varieties,
    ) {
    }
}
