<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * @see https://pokeapi.co/docs/v2#pokemonsprites
 */
final readonly class PokemonSprites extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var ?string $frontDefault The default depiction of this Pokémon from the front in battle. */
        #[Field(FieldType::STRING, apiName: 'front_default')]
        public ?string $frontDefault = null,

        /** @var ?string $frontShiny The shiny depiction of this Pokémon from the front in battle. */
        #[Field(FieldType::STRING, apiName: 'front_shiny')]
        public ?string $frontShiny = null,

        /** @var ?string $frontFemale The female depiction of this Pokémon from the front in battle. */
        #[Field(FieldType::STRING, apiName: 'front_female')]
        public ?string $frontFemale = null,

        /** @var ?string $frontShinyFemale The shiny female depiction of this Pokémon from the front in battle. */
        #[Field(FieldType::STRING, apiName: 'front_shiny_female')]
        public ?string $frontShinyFemale = null,

        /** @var ?string $backDefault The default depiction of this Pokémon from the back in battle. */
        #[Field(FieldType::STRING, apiName: 'back_default')]
        public ?string $backDefault = null,

        /** @var ?string $backShiny The shiny depiction of this Pokémon from the back in battle. */
        #[Field(FieldType::STRING, apiName: 'back_shiny')]
        public ?string $backShiny = null,

        /** @var ?string $backFemale The female depiction of this Pokémon from the back in battle. */
        #[Field(FieldType::STRING, apiName: 'back_female')]
        public ?string $backFemale = null,

        /** @var ?string $backShinyFemale The shiny female depiction of this Pokémon from the back in battle. */
        #[Field(FieldType::STRING, apiName: 'back_shiny_female')]
        public ?string $backShinyFemale = null,

        /** @var ?PokemonSpritesOther $other Other Sprites */
        #[Field(FieldType::ENTITY, definition: PokemonSpritesOther::class)]
        public ?PokemonSpritesOther $other = null,

        /** @var ?Collection $versions Version Sprites */
        #[Field(FieldType::COLLECTION)]
        public ?Collection $versions = null,
    ) {
    }
}
