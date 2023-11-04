<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Evolution;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Items\Item;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * Evolution chains are essentially family trees. They start with the lowest stage within a family and
 * detail evolution conditions for each as well as Pokémon they can evolve into up through the hierarchy.
 *
 * @see https://pokeapi.co/docs/v2#evolution-chains
 */
#[Endpoint(Resource::EVOLUTION_CHAIN)]
final readonly class EvolutionChain extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var ProxyEndpoint<Item>|Item|null $babyTriggerItem The item that a Pokémon would be holding when mating that would trigger the egg hatching a baby Pokémon rather than a basic Pokémon. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'baby_trigger_item', definition: Item::class)]
        public ProxyEndpoint|Item|null $babyTriggerItem,

        /** @var ChainLink $chain The base chain link object. Each link contains evolution details for a Pokémon in the chain. Each link references the next Pokémon in the natural evolution order. */
        #[Field(FieldType::ENTITY, definition: ChainLink::class)]
        public ChainLink $chain,
    ) {
    }
}
