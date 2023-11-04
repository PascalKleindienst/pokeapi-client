<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Habitats are generally different terrain Pokémon can be found in but can also be areas designated for rare or legendary Pokémon.
 *
 * @see https://pokeapi.co/docs/v2#pokemon-habitats
 */
#[Endpoint(Resource::POKEMON_HABITAT)]
final readonly class PokemonHabitat extends Entity
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

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $pokemonSpecies A list of the Pokémon species that can be found in this habitat. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $pokemonSpecies,

    ) {
    }
}
