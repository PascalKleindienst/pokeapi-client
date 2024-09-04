<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use JsonException;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\EntityManager;
use PokeDB\PokeApiClient\Exceptions\NetworkException;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use TypeError;

/**
 * @template T of Entity
 */
class Api
{
    public const API_ENDPOINT = 'https://pokeapi.co/api/v2/';

    protected EntityManager $entityManager;
    private static ?self $instance = null;

    /**
     * @var ReflectionClass<T>[]
     */
    private array $refClasses = [];

    public function __construct(
        private readonly string $url = self::API_ENDPOINT,
        private readonly ClientInterface $client = new HttpClient(),
        private readonly CacheItemPoolInterface $cache = new FilesystemAdapter('pokeapi')
    ) {
        $this->entityManager = new EntityManager();
        self::$instance = $this;
    }

    /**
     * Get API instance (if created already)
     * @return self<T>|null
     */
    public static function getInstance(): ?self
    {
        return self::$instance;
    }

    /**
     * @param class-string<T> $entity
     * @param string|int      $identifier
     * @phpstan-return T
     * @return Entity
     * @throws InvalidArgumentException if the cache key is somehow invalid
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
     * @param  class-string<T>  $entity
     *
     * @psalm-return ResourceList<T>
     *
     * @throws JsonException if there is some malformed api response
     * @throws NetworkException if there is some network error while fetching the API
     * @throws ReflectionException if the entity class does not exist
     * @throws InvalidArgumentException if the cache key is somehow invalid
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
     * @param  class-string<T>  $entity
     */
    protected function validateEntity(string $entity): void
    {
        if (! is_a($entity, Entity::class, true)) {
            throw new TypeError('Invalid type for parameter $entity. Expected ' . Entity::class . ' got ' . $entity);
        }
    }

    /**
     * @param  class-string<T>  $entity
     *
     * @throws ReflectionException
     */
    protected function getUrl(string $entity, string|int|null $identifier = null): string
    {
        if (! \array_key_exists($entity, $this->refClasses)) {
            $this->refClasses[$entity] = new ReflectionClass($entity);
        }

        $endpoint = strtolower($this->refClasses[$entity]->getShortName());

        $attributes = $this->refClasses[$entity]->getAttributes(Endpoint::class);
        if (! empty($attributes)) {
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
     * @phpstan-return ResourceList<T>
     */
    protected function createResourceList(string $entity, array $data = []): ResourceList
    {
        return ResourceList::create($entity, $data);
    }
}
