<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Encounter condition values are the various states that an encounter condition can have,
 * i.e., time of day can be either day or night.
 *
 * @see https://pokeapi.co/docs/v2#encounter-condition-values
 */
class EncounterConditionValue extends Entity
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
     * @var Collection The name of this resource listed in different languages.
     */
    protected $names;

    /**
     * @var EncounterCondition The condition this encounter condition value pertains to.
     */
    protected $condition;

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
     * Get the name of this resource listed in different languages.
     *
     * @return Collection
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    /**
     * Get the condition this encounter condition value pertains to.
     *
     * @return EncounterCondition
     */
    public function getCondition(): EncounterCondition
    {
        return $this->condition;
    }
}
