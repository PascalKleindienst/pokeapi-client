<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonstat
 */
final readonly class PokemonStat extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Stat>|Stat $stat The stat the Pokémon has. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Stat::class)]
        public ProxyEndpoint|Stat $stat,

        /** @var int $effort The effort points (EV) the Pokémon has in the stat. */
        #[Field(FieldType::NUMBER)]
        public int $effort,

        /** @var int $baseStat The base value of the stat. */
        #[Field(FieldType::NUMBER, apiName: 'base_stat')]
        public int $baseStat,
    ) {
    }
}
