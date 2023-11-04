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
 * Colors used for sorting Pokémon in a Pokédex.
 *
 * The color listed in the Pokédex is usually the color most apparent or covering each Pokémon's body.
 * No orange category exists; Pokémon that are primarily orange are listed as red or brown.
 *
 * @see https://pokeapi.co/docs/v2#pokemon-colors
 */
#[Endpoint(Resource::POKEMON_COLOR)]
final readonly class PokemonColor extends Entity
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

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $pokemonSpecies A list of the Pokémon species that have this color. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $pokemonSpecies,

    ) {
    }
}
