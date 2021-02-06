<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Exceptions\NetworkException;
use PokeDB\PokeApiClient\Utils\ClientInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * API Client.
 */
class Client implements ClientInterface
{
    public const API_ENDPOINT = 'https://pokeapi.co/api/v2/';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @param string $url
     * @param CacheInterface $cache
     */
    public function __construct(string $url = self::API_ENDPOINT, CacheInterface $cache = null)
    {
        $this->baseUrl = $url;
        $this->cache = $cache ?: new FilesystemCachePool(new Filesystem(new Local('pokeapi')));
    }

    /**
     * Send API Request.
     *
     * @template T of Entity
     * @psalm-return T
     * @param EntityDefinition $definition
     * @param string|int $identifier
     * @return Entity
     */
    public function sendRequest(EntityDefinition $definition, $identifier): Entity
    {
        // Build Url
        $uri = str_replace($this->baseUrl, '', $definition->getEndpoint());
        $url = sprintf("%s%s/", $this->baseUrl, $uri);
        $url .= str_replace($url, '', (string) $identifier);

        $definition->setClient($this);

        // Get from cache
        $cacheKey = hash('sha256', urlencode($url));

        if ($this->cache->has($cacheKey)) {
            return $definition->resolve(json_decode((string) $this->cache->get($cacheKey), true));
        }

        // Load Data
        $data = $this->request($url);
        $this->cache->set($cacheKey, json_encode($data));

        return $definition->resolve($data);
    }

    /**
     * curl request.
     *
     * @throws NetworkException if the is a curl error
     * @throws NetworkException if the request does not return a 200 HTTP status code
     * @param string $url
     * @return array
     */
    private function request(string $url): array
    {
        $handler = curl_init();
        $timeout = 5;

        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        if ($data === false) {
            $err = curl_error($handler);
            curl_close($handler);
            throw NetworkException::create($url, $err);
        }

        curl_close($handler);

        if ($code != 200) {
            throw NetworkException::create($url, (string) $data);
        }

        return json_decode((string) $data, true);
    }
}
