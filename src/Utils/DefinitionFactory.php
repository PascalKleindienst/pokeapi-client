<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use InvalidArgumentException;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;

/**
 * Factory trait for creating new entity definitions.
 */
trait DefinitionFactory
{
    /**
     * Create a new entity definition.
     *
     * @psalm-param class-string<EntityDefinition> $definitionClass
     * @param string $definitionClass
     * @param ClientInterface $client
     * @return EntityDefinition
     */
    public function createDefinition(string $definitionClass, ClientInterface $client = null): EntityDefinition
    {
        if (!class_exists($definitionClass)) {
            throw new InvalidArgumentException('Definition class ' . $definitionClass . ' does not exist!');
        }

        $definition = new $definitionClass();

        if (!empty($client)) {
            $definition->setClient($client);
        }

        return $definition;
    }
}
