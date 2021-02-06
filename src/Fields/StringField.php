<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;

/**
 * String Type Test Field
 */
class StringField extends Field
{
    /**
     * @inheritDoc
     */
    public function resolve(array $data, ClientInterface $client = null): string
    {
        return (string) $this->getDataStorageValue($data);
    }
}
