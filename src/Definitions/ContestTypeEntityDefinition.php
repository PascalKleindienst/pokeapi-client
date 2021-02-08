<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\ContestType;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Contest Type Entity Definition.
 */
class ContestTypeEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'contest-type';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return ContestType::class;
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
            new TranslatedField('colors', 'names', 'color'),
            new NamedAPIResourceField('berryFlavor', 'berry_flavor', BerryFlavorEntityDefinition::class)
        ]);
    }
}
