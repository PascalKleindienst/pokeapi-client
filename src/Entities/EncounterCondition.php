<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Conditions which affect what pokemon might appear in the wild, e.g., day or night.
 *
 * @see https://pokeapi.co/docs/v2#encounter-conditions
 */
class EncounterCondition extends Entity
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
     * @var Collection<EncounterConditionValue> A list of possible values for this encounter condition.
     */
    protected $values;

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
     * Get a list of possible values for this encounter condition.
     *
     * @return Collection<EncounterConditionValue>
     */
    public function getValues(): Collection
    {
        return $this->values;
    }
}
