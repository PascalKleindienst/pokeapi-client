<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Machines;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Machines are the representation of items that teach moves to Pokémon.
 *
 * They vary from version to version, so it is not certain that one specific TM or HM corresponds to a single Machine.
 *
 * @see https://pokeapi.co/docs/v2#move
 */
#[Endpoint(Resource::MACHINE)]
final readonly class Machine extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        // TODO
    ) {
    }
}
