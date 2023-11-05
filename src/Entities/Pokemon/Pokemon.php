<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\VersionGameIndex;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Pokémon are the creatures that inhabit the world of the Pokémon games.
 *
 * They can be caught using Pokéballs and trained by battling with other Pokémon. Each Pokémon belongs to
 * a specific species but may take on a variant which makes it differ from other Pokémon of the same species,
 * such as base stats, available abilities and typings. See Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#ability
 */
#[Endpoint(Resource::POKEMON)]
final readonly class Pokemon extends Entity
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

        /** @var int $baseExperience The base experience gained for defeating this Pokémon. */
        #[Field(FieldType::NUMBER, apiName: 'base_experience')]
        public int $baseExperience,

        /** @var int $height The height of this Pokémon in decimetres. */
        #[Field(FieldType::NUMBER)]
        public int $height,

        /** @var bool $isDefault Set for exactly one Pokémon used as the default for each species. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_default')]
        public bool $isDefault,

        /** @var int $order Order for sorting. Almost national order, except families are grouped together. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var int $weight The weight of this Pokémon in hectograms. */
        #[Field(FieldType::NUMBER)]
        public int $weight,

        /** @var Collection<PokemonAbility> $abilities A list of abilities this Pokémon could potentially have. */
        #[Field(FieldType::COLLECTION, definition: PokemonAbility::class)]
        public Collection $abilities,

        /** @var Collection<PokemonForm> $forms A list of forms this Pokémon can take on. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: PokemonForm::class)]
        public Collection $forms,

        /** @var Collection<VersionGameIndex> $gameIndices A list of game indices relevent to Pokémon item by generation. */
        #[Field(FieldType::COLLECTION, apiName: 'game_indices', definition: VersionGameIndex::class)]
        public Collection $gameIndices,

        /** @var Collection<PokemonHeldItem> $heldItems A list of items this Pokémon may be holding when encountered. */
        #[Field(FieldType::COLLECTION, apiName: 'held_items', definition: PokemonHeldItem::class)]
        public Collection $heldItems,

        /** @var string $locationAreaEncounters A link to a list of location areas, as well as encounter details pertaining to specific versions.. */
        #[Field(FieldType::STRING, apiName: 'location_area_encounters')]
        public string $locationAreaEncounters,

        /** @var Collection<PokemonMove> $moves A list of moves along with learn methods and level details pertaining to specific version groups. */
        #[Field(FieldType::COLLECTION, definition: PokemonMove::class)]
        public Collection $moves,

        /** @var Collection<PokemonTypePast> $pastTypes A list of details showing types this pokémon had in previous generations */
        #[Field(FieldType::COLLECTION, apiName: 'past_types', definition: PokemonTypePast::class)]
        public Collection $pastTypes,

        /** @var PokemonSprites $sprites A set of sprites used to depict this Pokémon in the game. */
        #[Field(FieldType::ENTITY, definition: PokemonSprites::class)]
        public PokemonSprites $sprites,

        /** @var ProxyEndpoint<PokemonSpecies>|PokemonSpecies $species The species this Pokémon belongs to. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: PokemonSpecies::class)]
        public ProxyEndpoint|PokemonSpecies $species,

        /** @var Collection<PokemonStat> $stats A list of base stat values for this Pokémon. */
        #[Field(FieldType::COLLECTION, definition: PokemonStat::class)]
        public Collection $stats,

        /** @var Collection<PokemonType> $types A list of details showing types this Pokémon has. */
        #[Field(FieldType::COLLECTION, definition: PokemonType::class)]
        public Collection $types,
    ) {
    }
}
