<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Evolution;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Evolution triggers are the events and conditions that cause a Pokémon to evolve.
 *
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#evolution-triggers
 */
#[Endpoint(Resource::EVOLUTION_TRIGGER)]
final readonly class EvolutionTrigger extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var Collection<PokemonSpecies> $pokemonSpecies A list of pokemon species that result from this evolution trigger.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, apiName: 'pokemon_species', definition: PokemonSpecies::class)]
        public Collection $pokemonSpecies,

        /** @var Collection<Collection<Name>> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
