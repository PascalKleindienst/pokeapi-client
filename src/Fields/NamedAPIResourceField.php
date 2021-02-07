<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\DefinitionFactory;
use PokeDB\PokeApiClient\Utils\ProxyFactory;
use ProxyManager\Proxy\VirtualProxyInterface;

/**
 * A NamedAPIResource Field.
 */
class NamedAPIResourceField extends Field
{
    use DefinitionFactory;
    use ProxyFactory;

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
     * @return VirtualProxyInterface|Entity
     */
    public function resolve(array $data, ClientInterface $client = null)
    {
        $resource = $this->getDataStorageValue($data);
        $definition = $this->createDefinition($this->definition, $client);
        $identifier = $resource['name'] ?? $resource['url'];

        return $this->createProxy($definition, $identifier);
    }
}
