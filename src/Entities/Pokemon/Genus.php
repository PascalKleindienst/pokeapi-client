<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Language;
use PokeDB\PokeApiClient\Entities\Utility\Translateable;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#genus
 */
final class Genus extends Entity implements Translateable
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $genus The localized genus for the referenced Pokémon species. */
        #[Field(FieldType::STRING)]
        public string $genus,

        /** @var Language $language The language this name is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public Language $language,
        public string $locale,
    ) {
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
