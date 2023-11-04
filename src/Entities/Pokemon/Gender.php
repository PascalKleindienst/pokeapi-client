<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Genders were introduced in Generation II for the purposes of breeding Pokémon but can also result in visual differences or even different evolutionary lines. Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#genders
 */
#[Endpoint(Resource::GENDER)]
final readonly class Gender extends Entity
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

        /** @var Collection<PokemonSpecies> $requiredForEvolution A list of Pokémon species that required this gender in order for a Pokémon to evolve into them. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'required_for_evolution', definition: PokemonSpecies::class)]
        public Collection $requiredForEvolution,

        /** @var Collection<Collection<PokemonSpeciesGender>> $pokemonSpeciesDetails A list of Pokémon species that can be this gender and how likely it is that they will be. */
        #[Field(FieldType::COLLECTION, apiName: 'pokemon_species_details', definition: PokemonSpeciesGender::class)]
        public Collection $pokemonSpeciesDetails,
    ) {
    }
}
