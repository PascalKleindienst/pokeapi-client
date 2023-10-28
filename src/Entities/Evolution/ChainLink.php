<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Evolution;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\PokemonSpecies;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#evolution-chains
 */
final readonly class ChainLink extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var bool $isBaby Whether or not this link is for a baby Pokémon. This would only ever be true on the base link. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_baby')]
        public bool $isBaby,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $species The Pokémon species at this point in the evolution chain. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $species,

        /** @var Collection<EvolutionDetail> $evolutionDetails All details regarding the specific details of the referenced Pokémon species evolution. */
        #[Field(FieldType::COLLECTION, apiName: 'evolution_details', definition: EvolutionDetail::class)]
        public Collection $evolutionDetails,

        /** @var Collection<ChainLink> $evolvesTo A List of chain objects. */
        #[Field(FieldType::COLLECTION, apiName: 'evolves_to', definition: ChainLink::class)]
        public Collection $evolvesTo,
    ) {
    }
}
