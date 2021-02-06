<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;

/**
 * Boolean Type Field.
 */
class BooleanField extends Field
{
    /**
     * @inheritDoc
     */
    public function resolve(array $data, ClientInterface $client = null): bool
    {
        return (bool) $this->getDataStorageValue($data);
    }
}
