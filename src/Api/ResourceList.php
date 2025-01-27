<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;
use PokeDB\PokeApiClient\Utils\ResourceIdentifier;

/**
 * @template T of Entity
 */
final class ResourceList extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $count The total number of resources available from this API. */
        public int $count,

        /** @var ApiResourceCollection<T> $results A list of named API resources. */
        public ApiResourceCollection $results,

        /** @var ?string $next The URL for the next page in the list. */
        public ?string $next = null,

        /** @var ?string $previous The URL for the previous page in the list. */
        public ?string $previous = null,
    ) {
    }

    /**
     * @param class-string<T> $entity
     * @param array{count?: int, next?: string, previous?: string, results?: array} $data
     */
    public static function create(string $entity, array $data): self
    {
        return new self(
            $data['count'] ?? 0,
            ApiResourceCollection::create($entity, array_map(static fn(array $res) => new ResourceIdentifier($res),$data['results'] ?? [])),
            $data['next'] ?? null,
            $data['previous'] ?? null,
        );
    }
}
