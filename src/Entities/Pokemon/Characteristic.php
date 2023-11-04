<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Description;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Characteristics indicate which stat contains a Pokémon's highest IV.
 *
 * A Pokémon's Characteristic is determined by the remainder of its highest IV divided by 5 (gene_modulo).
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#stat
 */
#[Endpoint(Resource::CHARACTERISTIC)]
final readonly class Characteristic extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var int $geneModulo The remainder of the highest stat/IV divided by 5. */
        #[Field(FieldType::NUMBER, apiName: 'gene_modulo')]
        public int $geneModulo,

        /** @var int[] $possibleValues The possible values of the highest stat that would result in a Pokémon recieving this characteristic when divided by 5. */
        #[Field(FieldType::LIST, apiName: 'possible_values')]
        public array $possibleValues,

        /** @var ProxyEndpoint<Stat>|Stat $highestStat The stat which results in this characteristic.. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'highest_stat', definition: Type::class)]
        public ProxyEndpoint|Stat $highestStat,

        /** @var Collection<Description> $descriptions The descriptions of this characteristic listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Description::class)]
        public Collection $descriptions,
    ) {
    }
}
