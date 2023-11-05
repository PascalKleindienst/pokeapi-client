<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use JsonException;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;
use PokeDB\PokeApiClient\Exceptions\NetworkException;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\CacheInterface;
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

    public function __construct(
        private readonly string $url = self::API_ENDPOINT,
        private readonly ClientInterface $client = new HttpClient(),
        private readonly CacheInterface $cache = new FilesystemAdapter('pokeapi')
    ) {
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
        $this->validateEntity($entity);
        $url = $this->getUrl($entity, $identifier);

        // Get from cache
        $cacheKey = hash('sha256', urlencode($url));
        $cache = $this->cache->getItem($cacheKey);

        if ($cache->isHit()) {
            $data = $cache->get();
            return $this->entityManager->create($entity, (array) $data);
        }

        $data = $this->client->request($url);
        $cache->set($data);
        $this->cache->save($cache);

        return $this->entityManager->create($entity, $data);
    }

    /**
     * @param class-string<T> $entity
     * @psalm-return ResourceList<T>
     * @throws JsonException
     * @throws NetworkException
     * @throws ReflectionException
     */
    public function all(string $entity, int $limit = 20, int $offset = 0): ResourceList
    {
        $this->validateEntity($entity);
        $url = $this->getUrl($entity);
        $url .= '?' . http_build_query(['limit' => $limit, 'offset' => $offset]);

        // Get from cache
        $cacheKey = hash('sha256', urlencode($url));
        $cache = $this->cache->getItem($cacheKey);

        if ($cache->isHit()) {
            $data = $cache->get();
            return $this->createResourceList($entity, (array) $data);
        }

        $data = $this->client->request($url);
        $cache->set($data);
        $this->cache->save($cache);

        return $this->createResourceList($entity, $data);
    }

    /**
     * @param class-string<T> $entity
     * @return void
     */
    protected function validateEntity(string $entity): void
    {
        if (!is_a($entity, Entity::class, true)) {
            throw new TypeError('Invalid type for parameter $entity. Expected ' . Entity::class . ' got ' . $entity);
        }
    }

    /**
     * @param class-string<T> $entity
     * @throws ReflectionException
     */
    protected function getUrl(string $entity, string|int|null $identifier = null): string
    {
        if (!\array_key_exists($entity, $this->refClasses)) {
            $this->refClasses[$entity] = new ReflectionClass($entity);
        }

        $endpoint = strtolower($this->refClasses[$entity]->getShortName());

        $attributes = $this->refClasses[$entity]->getAttributes(Endpoint::class);
        if (!empty($attributes)) {
            $endpointAttr = $attributes[0]->newInstance();
            $endpoint = $endpointAttr->resource->value;
        }

        $url = sprintf('%s%s/%s', $this->url, $endpoint, $identifier ?? '');
        if ($identifier && str_contains($endpoint, '%s')) {
            $endpoint = sprintf($endpoint, $identifier);
            $url = sprintf('%s%s', $this->url, $endpoint);
        }

        return $url;
    }

    /**
     * @param class-string<T> $entity
     * @psalm-return ResourceList<T>
     */
    protected function createResourceList(string $entity, array $data = []): ResourceList
    {
        $result = $data['results'] ?? [];
        foreach ($result as $key => $resource) {
            $result[$key] = new ProxyEndpoint($this->entityManager, $entity, $resource);
        }

        /** @var ResourceList<T> $resourceList */
        $resourceList = new ResourceList(
            $data['count'] ?? 0,
            $data['next'] ?? null,
            $data['previous'] ?? null,
            $result,
        );

        return $resourceList;
    }
}
