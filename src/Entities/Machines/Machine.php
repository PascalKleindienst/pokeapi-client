<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Machines;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Items\Item;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * Machines are the representation of items that teach moves to Pokémon.
 *
 * They vary from version to version, so it is not certain that one specific TM or HM corresponds to a single Machine.
 *
 * @see https://pokeapi.co/docs/v2#move
 */
#[Endpoint(Resource::MACHINE)]
final class Machine extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var Item $item The TM or HM item that corresponds to this machine. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Item::class)]
        public Item $item,

        /** @var Move $move The move that is taught by this machine. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Move::class)]
        public Move $move,

        /** @var VersionGroup $versionGroup The version group that this machine applies to. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public VersionGroup $versionGroup,
    ) {
    }
}
