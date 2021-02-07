<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\Collection;
use PokeDB\PokeApiClient\Utils\ProxyFactory;

/**
 * Named API Resource list field.
 */
class NamedAPIResourceListField extends ArrayField
{
    use ProxyFactory;

    /**
     * @inheritDoc
     */
    public function resolve(array $data, ClientInterface $client = null): Collection
    {
        $resource = $this->getDataStorageValue($data);
        $definition = $this->createDefinition($this->definition, $client);
        $collection = $definition->createEntityCollection();

        foreach ($resource as $field) {
            $identifier = $field['name'] ?? $field['url'];
            $proxy = $this->createProxy($definition, $identifier);

            $collection->add($proxy);
        }

        return $collection;
    }
}
