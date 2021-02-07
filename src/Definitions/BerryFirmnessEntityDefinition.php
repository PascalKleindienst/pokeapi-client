<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\BerryFirmness;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceListField;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Berry Firmness Entity Definition.
 */
class BerryFirmnessEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'berry-firmness';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return BerryFirmness::class;
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
            new NamedAPIResourceListField('berries', 'berries', BerryEntityDefinition::class)
        ]);
    }
}
