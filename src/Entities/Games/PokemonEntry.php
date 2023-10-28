<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Games;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonentry
 */
final readonly class PokemonEntry extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $entryNumber The index of this Pokémon species entry within the Pokédex. */
        #[Field(FieldType::NUMBER, apiName: 'entry_number')]
        public int $entryNumber,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $pokemonSpecies The Pokémon species being encountered. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $pokemonSpecies,
    ) {
    }
}
