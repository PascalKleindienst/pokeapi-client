<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\BerryFlavor;
use PokeDB\PokeApiClient\Fields\ArrayField;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Berry Flavor Entity Definition.
 */
class BerryFlavorEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'berry-flavor';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return BerryFlavor::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('id'),
            new StringField('name'),
            new TranslatedField('names', 'names', 'name'),
            new ArrayField('berries', 'berries', FlavorBerryMapEntityDefinition::class)
        ]);
    }
}
