<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Super contest effects refer to the effects of moves when used in super contests.
 */
class SuperContestEffect extends Entity
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
     * @var Collection The flavor text of this contest effect listed in different languages.
     */
    protected $flavorTexts;

    // TODO: Implement Moves
    // @var Collection<Move>
    // protected $moves;

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
     * Get the flavor text of this contest effect listed in different languages.
     *
     * @return Collection
     */
    public function getFlavorTexts(): Collection
    {
        return $this->flavorTexts;
    }
}
