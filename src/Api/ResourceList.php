<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;

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
}
