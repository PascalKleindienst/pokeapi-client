<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\Collection;
use PokeDB\PokeApiClient\Utils\DefinitionFactory;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;

/**
 * Array Type Field.
 */
class ArrayField extends Field
{
    use DefinitionFactory;

    /**
     * @psalm-var class-string<EntityDefinition>
     * @var string
     */
    protected $definition;

    /**
     * @psalm-param class-string<EntityDefinition> $definition
     * @param string $propertyName Name of the entity property.
     * @param string $storageName Name of the storage property.
     * @param string $definition Definition Class.
     */
    public function __construct(string $propertyName, string $storageName, string $definition)
    {
        parent::__construct($propertyName, $storageName);
        $this->definition = $definition;
    }

    /**
     * @inheritDoc
     */
    public function resolve(array $data, ClientInterface $client = null): Collection
    {
        $fields = $this->getDataStorageValue($data);
        $definition = $this->createDefinition($this->definition, $client);
        $collection = $definition->createEntityCollection();
        foreach ($fields as $field) {
            $collection->add($definition->resolve($field));
        }

        return $collection;
    }
}
