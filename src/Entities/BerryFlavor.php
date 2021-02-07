<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Flavors determine whether a Pokémon will benefit or suffer from eating a berry based on their nature.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#berry-flavors
 */
class BerryFlavor extends Entity
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
     * @var Collection<FlavorBerryMap> A list of the berries with this flavor.
     */
    protected $berries;

    /**
     * @var Collection The name of this resource listed in different languages.
     */
    protected $names;

    // TODO: protected $contestType;

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
     * Get a list of the berries with this flavor.
     *
     * @return Collection<FlavorBerryMap>
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
