<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Contest effects refer to the effects of moves when used in contests.
 */
class ContestEffect extends Entity
{
    /**
     * @var int The identifier for this resource.
     */
    protected $id;

    /**
     * @var int The base number of hearts the user of this move gets.
     */
    protected $appeal;

    /**
     * @var int The base number of hearts the user's opponent loses.
     */
    protected $jam;

    /**
     * @var Collection The result of this contest effect listed in different languages.
     */
    protected $effects;

    /**
     * @var Collection The flavor text of this contest effect listed in different languages.
     */
    protected $flavorTexts;

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
     * Get the base number of hearts the user of this move gets.
     *
     * @return int
     */
    public function getAppeal(): int
    {
        return $this->appeal;
    }

    /**
     * Get the base number of hearts the user's opponent loses.
     *
     * @return int
     */
    public function getJam(): int
    {
        return $this->jam;
    }

    /**
     * Get the result of this contest effect listed in different languages.
     *
     * @return Collection
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    /**
     * Get the flavor text of this contest effect listed in different languages.
     *
     * @return Collection
     */
    public function getFlavorTexts(): Collection
    {
        return $this->flavorTexts;
    }
}
