<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#description
 */
final readonly class Description extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $description The localized description for an API resource in a specific language.. */
        #[Field(FieldType::STRING)]
        public string $description,

        /** @var ProxyEndpoint<Language>|Language $language The language this effect is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public ProxyEndpoint|Language $language,
        public string $locale
    ) {
    }
}
