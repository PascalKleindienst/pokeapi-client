<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Contest types are categories judges used to weigh a Pokémon's condition in Pokémon contests.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#contest-types
 */
class ContestType extends Entity
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
     * @var BerryFlavor The berry flavor that correlates with this contest type.
     */
    protected $berryFlavor;

    /**
     * @var Collection The name of this contest type listed in different languages.
     */
    protected $names;

    /**
     * @var Collection The color associated with this contest's name in different languages.
     */
    protected $colors;

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
     * Get the berry flavor that correlates with this contest type.
     *
     * @return BerryFlavor
     */
    public function getBerryFlavor(): BerryFlavor
    {
        return $this->berryFlavor;
    }

    /**
     * Get the name of this contest type listed in different languages.
     *
     * @return Collection
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    /**
     * Get the color associated with this contest's name in different languages.
     *
     * @return Collection
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }
}
