<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

final readonly class ResourceIdentifier
{
    public ?string $name;
    public ?string $url;
    public ?string $identifier;

    /**
     * @param array{name?: string, url?: string} $resource
     */
    public function __construct(array $resource)
    {
        $this->name = $resource['name'] ?? null;
        $this->url = $resource['url'] ?? null;
        $this->identifier = $resource['name'] ?? pathinfo($resource['url'] ?? '', PATHINFO_FILENAME);
    }
}
