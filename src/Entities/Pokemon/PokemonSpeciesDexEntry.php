<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Pokedex;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonspeciesdexentry
 */
final readonly class PokemonSpeciesDexEntry extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $entryNumber The index number within the Pokédex. */
        #[Field(FieldType::NUMBER, apiName: 'entry_number')]
        public int $entryNumber,

        /** @var ProxyEndpoint<Pokedex>|Pokedex $pokedex The Pokédex the referenced Pokémon species can be found in.. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokedex::class)]
        public ProxyEndpoint|Pokedex $pokedex,
    ) {
    }
}
