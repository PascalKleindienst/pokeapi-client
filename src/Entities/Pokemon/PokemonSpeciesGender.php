<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemonspeciesgender
 */
final readonly class PokemonSpeciesGender extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $rate The chance of this Pokémon being female, in eighths; or -1 for genderless. */
        #[Field(FieldType::NUMBER)]
        public int $rate,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var Collection<PokemonSpecies> $pokemonSpecies A Pokémon species that can be the referenced gender. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public Collection $pokemonSpecies,
    ) {
    }
}
