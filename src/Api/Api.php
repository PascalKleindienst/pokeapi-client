<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use JsonException;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;
use PokeDB\PokeApiClient\Exceptions\NetworkException;
use Psr\SimpleCache\CacheInterface;
use ReflectionClass;
use ReflectionException;
use TypeError;

/**
 * @template T of Entity
 */
class Api
{
    public const API_ENDPOINT = 'https://pokeapi.co/api/v2/';

    protected EntityManager $entityManager;

    /**
     * @var ReflectionClass<T>[]
     */
    private array $refClasses = [];

    protected CacheInterface $cache;

    public function __construct(
        private readonly string $url = self::API_ENDPOINT,
        private readonly ClientInterface $client = new HttpClient(),
        CacheInterface $cache = null
    ) {
        $this->cache = $cache ?: new FilesystemCachePool(new Filesystem(new Local('pokeapi')));
        $this->entityManager = new EntityManager($this);
    }

    /**
     * @param class-string<T> $entity
     * @param string|int $identifier
     * @psalm-return T
     * @return Entity
     * @throws JsonException if there is some malformed api response
     * @throws NetworkException if there is some network error while fetching the API
     * @throws ReflectionException if the entity class does not exist
     */
    public function get(string $entity, string|int $identifier): Entity
    {
        if (!is_a($entity, Entity::class, true)) {
            throw new TypeError('Invalid type for parameter $entity. Expected ' . Entity::class . ' got ' . $entity);
        }

        if (!\array_key_exists($entity, $this->refClasses)) {
            $this->refClasses[$entity] = new ReflectionClass($entity);
        }

        $endpoint = strtolower($this->refClasses[$entity]->getShortName());

        $attributes = $this->refClasses[$entity]->getAttributes(Endpoint::class);
        if (!empty($attributes)) {
            $endpointAttr = $attributes[0]->newInstance();
            $endpoint = $endpointAttr->resource->value;
        }

        $url = sprintf('%s%s/%s', $this->url, $endpoint, $identifier);
        if (str_contains($endpoint, '%s')) {
            $endpoint = sprintf($endpoint, $identifier);
            $url = sprintf('%s%s', $this->url, $endpoint);
        }

        // Get from cache
        $cacheKey = hash('sha256', urlencode($url));
        if ($this->cache->has($cacheKey)) {
            $data = $this->cache->get($cacheKey);
            return $this->entityManager->create($entity, (array) $data);
        }

        $data = $this->client->request($url);
        $this->cache->set($cacheKey, $data);

        return $this->entityManager->create($entity, $data);
    }

    public function all(string $entity, int $limit = 20, int $offset = 0): void
    {
    }
}