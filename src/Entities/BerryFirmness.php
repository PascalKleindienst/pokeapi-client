<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * The firmness of a berry.
 */
class BerryFirmness extends Entity
{
    /**
     * @var int The identifier for this resource.
     */
    protected $id;

    /**
     * @var string The name for this resource.
     */
    protected $name;

    /**
     * @var Collection<Berry> A list of the berries with this firmness.
     */
    protected $berries;

    /**
     * @var Collection The name of this resource listed in different languages.
     */
    protected $names;

    /**
     * Get the identifier for this resource.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name for this resource.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get a list of the berries with this firmness.
     *
     * @return Collection<Berry>
     */
    public function getBerries(): Collection
    {
        return $this->berries;
    }

    /**
     * Get the name of this resource listed in different languages.
     *
     * @return Collection
     */
    public function getNames(): Collection
    {
        return $this->names;
    }
}
