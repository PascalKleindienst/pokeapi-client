<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Moves\MoveLearnMethod;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonmoveversion
 */
final readonly class PokemonMoveVersion extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<MoveLearnMethod>|MoveLearnMethod $moveLearnMethod The method by which the move is learned. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'move_learn_method', definition: MoveLearnMethod::class)]
        public ProxyEndpoint|MoveLearnMethod $moveLearnMethod,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group in which the move is learned. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,

        /** @var int $levelLearnedAt The minimum level to learn the move. */
        #[Field(FieldType::NUMBER, apiName: 'level_learned_at')]
        public int $levelLearnedAt,
    ) {
    }
}
