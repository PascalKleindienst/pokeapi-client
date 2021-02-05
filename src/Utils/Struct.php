<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use JsonSerializable;

/**
 * Simple Data Structure.
 */
class Struct implements JsonSerializable
{
    /**
     * Get elements of the struct.
     *
     * @return array
     */
    public function getVars(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $vars = $this->getVars();
        $this->convertDateTimePropertiesToJsonStringRepresentation($vars);

        return $vars;
    }

    /**
     * Convert data time properties to json string format.
     *
     * @param array $array
     * @return void
     */
    protected function convertDateTimePropertiesToJsonStringRepresentation(array &$array): void
    {
        foreach ($array as &$value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format(\DateTime::RFC3339_EXTENDED);
            }
        }
    }
}
