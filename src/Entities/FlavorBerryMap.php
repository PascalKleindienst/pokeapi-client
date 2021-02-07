<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

/**
 * Map between berry and flavor.
 *
 * Flavors determine whether a Pokémon will benefit or suffer from eating a berry based on their nature.
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#berry-flavors
 */
class FlavorBerryMap extends Entity
{
    /**
     * @var int How powerful the referenced flavor is for this berry.
     */
    protected $potency;

    /**
     * @var Berry The berry with the referenced flavor.
     */
    protected $berry;

    /**
     * Get how powerful the referenced flavor is for this berry.
     *
     * @return int
     */
    public function getPotency(): int
    {
        return $this->potency;
    }

    /**
     * Get the berry with the referenced flavor.
     *
     * @return Berry
     */
    public function getBerry(): Berry
    {
        return $this->berry;
    }
}
