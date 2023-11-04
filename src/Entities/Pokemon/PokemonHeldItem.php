<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Items\Item;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemonhelditem
 */
final readonly class PokemonHeldItem extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Item>|Item $item The item the referenced Pokémon holds. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Item::class)]
        public ProxyEndpoint|Item $item,

        /** @var Collection<PokemonHeldItemVersion> $versionDetails The details of the different versions in which the item is held. */
        #[Field(FieldType::COLLECTION, apiName: 'version_details', definition: PokemonHeldItemVersion::class)]
        public Collection $versionDetails,
    ) {
    }
}
