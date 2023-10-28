<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Items;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Evolution\EvolutionChain;
use PokeDB\PokeApiClient\Entities\Utility\GenerationGameIndex;
use PokeDB\PokeApiClient\Entities\Utility\MachineVersionDetail;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Entities\Utility\VerboseEffect;
use PokeDB\PokeApiClient\Entities\Utility\VersionGroupFlavorText;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * An item is an object in the games which the player can pick up, keep in their bag, and use in some manner.
 * They have various uses, including healing, powering up, helping catch Pokémon, or to access a new area.
 *
 * @see https://pokeapi.co/docs/v2#item
 */
#[Endpoint(Resource::ITEM)]
final readonly class Item extends Entity
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

        /** @var int $cost The price of this item in stores. */
        #[Field(FieldType::NUMBER)]
        public int $cost,

        /** @var int $flingPower The power of the move Fling when used with this item. */
        #[Field(FieldType::NUMBER, apiName: 'fling_power')]
        public int $flingPower,

        /** @var ProxyEndpoint<ItemFlingEffect>|ItemFlingEffect $flingEffect The effect of the move Fling when used with this item. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'fling_effect', definition: ItemFlingEffect::class)]
        public ProxyEndpoint|ItemFlingEffect $flingEffect,

        /** @var Collection<ItemFlingEffect> $attributes A list of attributes this item has. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: ItemFlingEffect::class)]
        public Collection $attributes,

        /** @var ProxyEndpoint<ItemCategory>|ItemCategory $category The category of items this item falls into. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: ItemCategory::class)]
        public ProxyEndpoint|ItemCategory $category,

        /** @var Collection<VerboseEffect> $effectEntries The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'effect_entries', definition: VerboseEffect::class)]
        public Collection $effectEntries,

        /** @var Collection<VersionGroupFlavorText> $flavorTextEntries The flavor text of this ability listed in different languages. */
        #[Field(FieldType::TRANSLATION, apiName: 'flavor_text_entries', definition: VersionGroupFlavorText::class)]
        public Collection $flavorTextEntries,

        /** @var Collection<GenerationGameIndex> $gameIndices A list of game indices relevent to this item by generation. */
        #[Field(FieldType::COLLECTION, apiName: 'game_indices', definition: GenerationGameIndex::class)]
        public Collection $gameIndices,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var ItemSprites $sprites  A set of sprites used to depict this item in the game. */
        #[Field(FieldType::ENTITY, definition: ItemSprites::class)]
        public ItemSprites $sprites,

        /** @var Collection<ItemHolderPokemon> $heldByPokemon A list of Pokémon that might be found in the wild holding this item. */
        #[Field(FieldType::COLLECTION, apiName: 'held_by_pokemon', definition: ItemHolderPokemon::class)]
        public Collection $heldByPokemon,

        /** @var ProxyEndpoint<EvolutionChain>|EvolutionChain $babyTriggerFor An evolution chain this item requires to produce a bay during mating. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'baby_trigger_for', definition: EvolutionChain::class)]
        public ProxyEndpoint|EvolutionChain $babyTriggerFor,

        /** @var Collection<MachineVersionDetail> $machines A list of the machines related to this item. */
        #[Field(FieldType::COLLECTION, definition: MachineVersionDetail::class)]
        public Collection $machines,
    ) {
    }
}
