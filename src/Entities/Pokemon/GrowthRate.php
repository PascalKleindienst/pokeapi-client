<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Growth rates are the speed with which Pokémon gain levels through experience. Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#growth-rates
 */
#[Endpoint(Resource::GROWTH_RATE)]
final readonly class GrowthRate extends Entity
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

        /** @var string $formula The formula used to calculate the rate at which the Pokémon species gains level. */
        #[Field(FieldType::STRING)]
        public string $formula,

        /** @var Collection<Description> $descriptions The descriptions of this characteristic listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,

        /** @var Collection<GrowthRateExperienceLevel> $levels A list of levels and the amount of experienced needed to atain them based on this growth rate. */
        #[Field(FieldType::COLLECTION, definition: GrowthRateExperienceLevel::class)]
        public Collection $levels,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $pokemonSpecies A list of Pokémon species that gain levels at this growth rate.. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $pokemonSpecies,
    ) {
    }
}
