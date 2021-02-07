<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\FlavorBerryMap;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Fields\NumberField;

/**
 * Mapping between flavor and berry entity.
 */
class FlavorBerryMapEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return FlavorBerryMap::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('potency'),
            new NamedAPIResourceField('berry', 'berry', BerryEntityDefinition::class)
        ]);
    }
}
