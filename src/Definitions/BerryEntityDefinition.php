<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\Berry;
use PokeDB\PokeApiClient\Fields\ArrayField;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;

/**
 * Entity Definition for berries.
 *
 * @see https://pokeapi.co/docs/v2#berries
 */
class BerryEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'berry';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Berry::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('id'),
            new StringField('name'),
            new NumberField('growthTime', 'growth_time'),
            new NumberField('maxHarvest', 'max_harvest'),
            new NumberField('naturalGiftPower', 'natural_gift_power'),
            new NumberField('size'),
            new NumberField('smoothness'),
            new NumberField('soilDryness', 'soil_dryness'),
            new NamedAPIResourceField('firmness', 'firmness', BerryFirmnessEntityDefinition::class),
            new ArrayField('flavors', 'flavors', BerryFlavorMapEntityDefinition::class)
        ]);
    }
}
