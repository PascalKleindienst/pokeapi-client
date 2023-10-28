<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Pokemon\Pokemon;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#itemholderpokemon
 */
final readonly class ItemHolderPokemon extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Pokemon>|Pokemon $pokemon The Pokémon that holds this item. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public ProxyEndpoint|Pokemon $pokemon,

        /** @var Collection<ItemHolderPokemonVersionDetail> $versionDetails The details for the version that this item is held in by the Pokémon. */
        #[Field(FieldType::COLLECTION, apiName: 'version_details', definition: ItemHolderPokemonVersionDetail::class)]
        public Collection $versionDetails,
    ) {
    }
}
