<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Exceptions;

/**
 * Network Exception
 */
class NetworkException extends \Exception
{
    public static function create(string $endpoint, string $response): NetworkException
    {
        $message = sprintf('Error occured when querying endpoint %s. Error: %s', $endpoint, $response);

        return new self($message);
    }
}
