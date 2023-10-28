<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Contests;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Moves\Move;
use PokeDB\PokeApiClient\Entities\Utility\FlavorText;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Contest effects refer to the effects of moves when used in contests.
 *
 * @see https://pokeapi.co/docs/v2#contest-effects
 */
#[Endpoint(Resource::SUPER_CONTEST_EFFECT)]
final readonly class SuperContestEffect extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The ID of this resource */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var int $appeal The base number of hearts the user of this move gets. */
        #[Field(FieldType::NUMBER)]
        public int $appeal,

        /** @var Collection<FlavorText> $flavorTexts The flavor text of this contest effect listed in different languages. */
        #[Field(FieldType::TRANSLATION, 'flavor_text_entries', definition: FlavorText::class)]
        public Collection $flavorTexts,

        /** @var Collection<Move> $moves A list of moves that have the effect when used in super contests. */
        #[Field(FieldType::NAMED_API_RESOURCE_LIST, definition: Move::class)]
        public Collection $moves,
    ) {
    }
}
