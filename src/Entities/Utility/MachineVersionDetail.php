<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Machines\Machine;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#machineversiondetail
 */
final readonly class MachineVersionDetail extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ProxyEndpoint<Machine>|Machine $machine The machine that teaches a move from an item. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Machine::class)]
        public ProxyEndpoint|Machine $machine,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group which uses this flavor text. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,
    ) {
    }
}
