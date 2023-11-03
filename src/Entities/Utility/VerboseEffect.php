<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#verboseeffect
 */
final readonly class VerboseEffect extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $effect The localized effect text for an API resource in a specific language. */
        #[Field(FieldType::STRING)]
        public string $effect,

        /** @var string $shortEffect The localized effect text in brief. */
        #[Field(FieldType::STRING, apiName: 'short_effect')]
        public string $shortEffect,

        /** @var ProxyEndpoint<Language>|Language $language The language this effect is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public ProxyEndpoint|Language $language,
        public string $locale,
    ) {
    }
}
