<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Field for Translations.
 */
class TranslatedField extends Field
{
    /**
     * @var string Locale
     */
    private $key;

    /**
     * @param string $propertyName Name of the entity property.
     * @param string $storageName Name of the storage property.
     * @param string $key Locale key
     */
    public function __construct(string $propertyName, string $storageName, string $key)
    {
        parent::__construct($propertyName, $storageName);
        $this->key = $key;
    }

    /**
     * @inheritDoc
     * @return Collection
     */
    public function resolve(array $data, ClientInterface $client = null): Collection
    {
        $fields = $this->getDataStorageValue($data);
        $translations = new Collection();

        foreach ($fields as $field) {
            $translations->set($field['language']['name'], $field[$this->key]);
        }

        return $translations;
    }
}
