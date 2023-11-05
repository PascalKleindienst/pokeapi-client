<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Generation;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Entities\Moves\MoveDamageClass;
use PokeDB\PokeApiClient\Entities\Utility\GenerationGameIndex;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Types are properties for Pokémon and their moves. Each type has three properties:
 * which types of Pokémon it is super effective against, which types of Pokémon it is not very effective against,
 * and which types of Pokémon it is completely ineffective against.
 *
 * @see https://pokeapi.co/docs/v2#type
 */
#[Endpoint(Resource::TYPE)]
final readonly class Type extends Entity
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

        /** @var TypeRelations $damageRelations A detail of how effective this type is toward others and vice versa. */
        #[Field(FieldType::ENTITY, apiName: 'damage_relations', definition: TypeRelations::class)]
        public TypeRelations $damageRelations,

        /** @var Collection<TypeRelations> $pastDamageRelations A list of details of how effective this type was toward others and vice versa in previous generations */
        #[Field(FieldType::COLLECTION, apiName: 'past_damage_relations', definition: TypeRelations::class)]
        public Collection $pastDamageRelations,

        /** @var Collection<GenerationGameIndex> $gameIndices A list of game indices relevent to this item by generation. */
        #[Field(FieldType::COLLECTION, apiName: 'game_indices', definition: GenerationGameIndex::class)]
        public Collection $gameIndices,

        /** @var ProxyEndpoint<Generation>|Generation $generation The generation this type was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Generation::class)]
        public ProxyEndpoint|Generation $generation,

        /** @var ProxyEndpoint<MoveDamageClass>|MoveDamageClass|null $moveDamageClass The class of damage this stat is directly related to. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'move_damage_class', definition: MoveDamageClass::class)]
        public ProxyEndpoint|MoveDamageClass|null $moveDamageClass,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<TypePokemon> $pokemon A list of details of Pokémon that have this type. */
        #[Field(FieldType::COLLECTION, definition: TypePokemon::class)]
        public Collection $pokemon,

        /** @var Collection<Move> $moves A list of moves that have this type.. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Move::class)]
        public Collection $moves,
    ) {
    }
}
