<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Methods by which the player might can encounter Pokémon in the wild, e.g., walking in tall grass.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#encounter-methods
 */
class EncounterMethod extends Entity
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
     * @var int A good value for sorting.
     */
    protected $order;

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
     * Get a good value for sorting.
     *
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
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
