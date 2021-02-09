<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\EncounterCondition;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceListField;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Encounter Condition Entity Definition.
 */
class EncounterConditionEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'encounter-condition';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return EncounterCondition::class;
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
            new NamedAPIResourceListField('values', 'values', EncounterConditionValueEntityDefinition::class),
        ]);
    }
}
