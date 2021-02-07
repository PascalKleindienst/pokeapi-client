<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Berries are small fruits that can provide HP and status condition restoration, stat enhancement,
 * and even damage negation when eaten by Pokémon.
 *
 * Check out Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#berries
 */
class Berry extends Entity
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
     * Time it takes the tree to grow one stage, in hours.
     * Berry trees go through four of these growth stages before they can be picked.
     *
     * @var int
     */
    protected $growthTime;

    /**
     * @var int The maximum number of these berries that can grow on one tree in Generation IV.
     */
    protected $maxHarvest;

    /**
     * @var int The power of the move "Natural Gift" when used with this Berry.
     */
    protected $naturalGiftPower;

    /**
     * Undocumented variable
     *
     * @var int The size of this Berry, in millimeters.
     */
    protected $size;

    /**
     * Undocumented variable
     *
     * @var int The smoothness of this Berry, used in making Pokéblocks or Poffins.
     */
    protected $smoothness;

    /**
     * The speed at which this Berry dries out the soil as it grows. A higher rate means the soil dries more quickly.
     *
     * @var int
     */
    protected $soilDryness;

    /**
     * @var BerryFirmness The firmness of this berry, used in making Pokéblocks or Poffins.
     */
    protected $firmness;

    /**
     * A list of references to each flavor a berry can have and
     * the potency of each of those flavors in regard to this berry.
     *
     * @var Collection<BerryFlavorMap>
     */
    protected $flavors;

    // TODO: protected $item;

    // TODO: protected $naturalGiftType;

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
     * Get berry trees go through four of these growth stages before they can be picked.
     *
     * @return int
     */
    public function getGrowthTime(): int
    {
        return $this->growthTime;
    }

    /**
     * Get the maximum number of these berries that can grow on one tree in Generation IV.
     *
     * @return int
     */
    public function getMaxHarvest(): int
    {
        return $this->maxHarvest;
    }

    /**
     * Get the power of the move "Natural Gift" when used with this Berry.
     *
     * @return int
     */
    public function getNaturalGiftPower(): int
    {
        return $this->naturalGiftPower;
    }

    /**
     * Get the size of this Berry, in millimeters.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get the smoothness of this Berry, used in making Pokéblocks or Poffins.
     *
     * @return int
     */
    public function getSmoothness(): int
    {
        return $this->smoothness;
    }

    /**
     * Get the speed at which this Berry dries out the soil as it grows.
     * A higher rate means the soil dries more quickly.
     *
     * @return int
     */
    public function getSoilDryness(): int
    {
        return $this->soilDryness;
    }

    /**
     * Get the firmness of this berry, used in making Pokéblocks or Poffins.
     *
     * @return BerryFirmness
     */
    public function getFirmness(): BerryFirmness
    {
        return $this->firmness;
    }

    /**
     * Get the potency of each of those flavors in regard to this berry.
     *
     * @return Collection<BerryFlavorMap>
     */
    public function getFlavors(): Collection
    {
        return $this->flavors;
    }
}
