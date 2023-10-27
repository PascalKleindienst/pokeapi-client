<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

interface ClientInterface
{
    /**
     * Send a HTTP GET request to the api and get the json response
     * @param string $url
     * @return array
     */
    public function request(string $url): array;
}
