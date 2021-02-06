<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Fields;

use PokeDB\PokeApiClient\Utils\ClientInterface;

/**
 * Number Type Field
 */
class NumberField extends Field
{
    /**
     * @inheritDoc
     * @return int|float|double
     */
    public function resolve(array $data, ClientInterface $client = null)
    {
        return $this->getDataStorageValue($data);
    }
}
