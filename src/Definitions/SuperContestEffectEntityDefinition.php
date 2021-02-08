<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Definitions;

use PokeDB\PokeApiClient\Entities\SuperContestEffect;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Fields\NumberField;
use PokeDB\PokeApiClient\Fields\TranslatedField;

/**
 * SuperContest Effect Entity Definition.
 */
class SuperContestEffectEntityDefinition extends EntityDefinition
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return 'super-contest-effect';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return SuperContestEffect::class;
    }

    /**
     * @inheritDoc
     */
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new NumberField('id'),
            new NumberField('appeal'),
            new TranslatedField('flavorTexts', 'flavor_text_entries', 'flavor_text'),
            // TODO: new ArrayField('moves', 'moves', MoveEntityDefinition::class),
        ]);
    }
}
