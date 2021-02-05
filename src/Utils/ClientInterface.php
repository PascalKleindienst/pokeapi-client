<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;

/**
 * Client Interface.
 */
interface ClientInterface
{
    /**
     * Send a request to the api.
     *
     * @param EntityDefinition $definition Entity Definition for the API endpoint.
     * @param string $identifier Identifier for the endpoint resource.
     * @return Entity
     */
    public function sendRequest(EntityDefinition $definition, string $identifier): Entity;
}
