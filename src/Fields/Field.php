<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use InvalidArgumentException;
use PokeDB\PokeApiClient\Utils\ClientInterface;

/**
 * Abstract Field Class.
 */
abstract class Field
{
    /**
     * @var string Name of the property in the entity.
     */
    protected $propertyName;

    /**
     * @var string Name of the property in the storage (ie. json document).
     */
    protected $storageName;

    /**
     * @param string $propertyName
     * @param string $storageName
     */
    public function __construct(string $propertyName, string $storageName = null)
    {
        $this->propertyName = $propertyName;
        $this->storageName = $storageName ?? $propertyName;
    }

    /**
     * Get the property name.
     *
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * Get the storage name.
     *
     * @return string
     */
    public function getStorageName(): string
    {
        return $this->storageName;
    }

    /**
     * Get the data storage value for the field.
     *
     * @param array $data
     * @return mixed
     */
    protected function getDataStorageValue(array $data)
    {
        if (!array_key_exists($this->storageName, $data)) {
            throw new InvalidArgumentException('Data has no attribute ' . $this->storageName);
        }

        return $data[$this->storageName];
    }

    /**
     * Resolve the field.
     *
     * @param array $data
     * @param ClientInterface|null $client
     * @return mixed
     */
    abstract public function resolve(array $data, ClientInterface $client = null);
}
