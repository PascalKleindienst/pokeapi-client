<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use JsonException;
use PokeDB\PokeApiClient\Exceptions\NetworkException;

class HttpClient implements ClientInterface
{
    /**
     * @throws NetworkException if there is some network error while fetching the API
     * @throws JsonException if there is some malformed api response
     */
    public function request(string $url): array
    {
        $handler = curl_init();
        $timeout = 5;

        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($handler);
        $code = (int) curl_getinfo($handler, CURLINFO_HTTP_CODE);

        if ($data === false) {
            $err = curl_error($handler);
            curl_close($handler);
            throw NetworkException::create($url, $err);
        }

        curl_close($handler);

        if ($code !== 200) {
            throw NetworkException::create($url, (string) $data);
        }

        /** @var array $response */
        $response = json_decode((string)$data, true, 512, JSON_THROW_ON_ERROR);
        return $response;
    }
}
