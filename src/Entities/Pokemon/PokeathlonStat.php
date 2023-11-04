<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Pokeathlon Stats are different attributes of a Pokémon's performance in Pokéathlons.
 *
 * In Pokéathlons, competitions happen on different courses; one for each of the different Pokéathlon stats.
 * See Bulbapedia for greater detail.
 *
 * @see https://pokeapi.co/docs/v2#pokeathlonstat
 */
#[Endpoint(Resource::POKEATHLON_STAT)]
final readonly class PokeathlonStat extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var int $id The identifier for this resource. */
        #[Field(FieldType::NUMBER)]
        public int $id,

        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var NaturePokeathlonStatAffectSets $affectingNatures A detail of natures which affect this Pokéathlon stat positively or negatively. */
        #[Field(FieldType::ENTITY, apiName: 'affecting_natures', definition: NaturePokeathlonStatAffectSets::class)]
        public NaturePokeathlonStatAffectSets $affectingNatures,

    ) {
    }
}
