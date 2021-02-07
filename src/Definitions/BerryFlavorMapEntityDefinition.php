<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\BerryFlavorMap;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Fields\NumberField;

/**
 * Mapping between berries and flavors.
 */
class BerryFlavorMapEntityDefinition extends EntityDefinition
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
        return BerryFlavorMap::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('potency'),
            new NamedAPIResourceField('flavor', 'flavor', BerryFlavorEntityDefinition::class)
        ]);
    }
}
