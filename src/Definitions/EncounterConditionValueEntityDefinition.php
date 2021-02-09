<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\EncounterConditionValue;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\StringField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Encounter Condition Value Entity Definition.
 */
class EncounterConditionValueEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'encounter-condition-value';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return EncounterConditionValue::class;
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
            new NamedAPIResourceField('condition', 'condition', EncounterConditionEntityDefinition::class),
        ]);
    }
}
