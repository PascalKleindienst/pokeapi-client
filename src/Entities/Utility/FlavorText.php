<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\Version;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#flavortext
 */
final class FlavorText extends Entity implements Translateable
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $flavorText The localized flavor text for an API resource in a specific language. Note that this text is left unprocessed as it is found in game files. This means that it contains special characters that one might want to replace with their visible decodable version. */
        #[Field(FieldType::STRING, 'flavor_text')]
        public string $flavorText,

        /** @var Language $language The language this name is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public Language $language,
        public string $locale,

        /** @var Version $version The game version this flavor text is extracted from. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Version::class)]
        public Version $version,
    ) {
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
