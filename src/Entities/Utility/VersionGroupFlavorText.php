<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#versiongroupflavortext
 */
final readonly class VersionGroupFlavorText extends Entity implements Translateable
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $text The localized name for an API resource in a specific language. */
        #[Field(FieldType::STRING)]
        public string $text,

        /** @var ProxyEndpoint<Language>|Language $language The language this effect is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public ProxyEndpoint|Language $language,
        public string $locale,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group which uses this flavor text. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,
    ) {
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
