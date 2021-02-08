<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\ContestEffect;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * Contest Effect Entity Definition.
 */
class ContestEffectEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'contest-effect';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return ContestEffect::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('id'),
            new NumberField('appeal'),
            new NumberField('jam'),
            new TranslatedField('effects', 'effect_entries', 'effect'),
            new TranslatedField('flavorTexts', 'flavor_text_entries', 'flavor_text'),
        ]);
    }
}
