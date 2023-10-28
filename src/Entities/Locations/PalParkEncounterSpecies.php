<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Locations;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#palparkencounterspecies
 */
final readonly class PalParkEncounterSpecies extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $baseScore The base score given to the player when this Pokémon is caught during a pal park run. */
        #[Field(FieldType::NUMBER, apiName: 'base_score')]
        public int $baseScore,

        /** @var int $rate The base rate for encountering this Pokémon in this pal park area. */
        #[Field(FieldType::NUMBER)]
        public int $rate,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $pokemonSpecies The Pokémon species being encountered. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $pokemonSpecies,
    ) {
    }
}
