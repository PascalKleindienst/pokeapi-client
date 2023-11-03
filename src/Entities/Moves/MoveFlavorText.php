<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Moves;

use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Utility\Language;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#moveflavortext
 */
final readonly class MoveFlavorText extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $flavorText The localized flavor text for an API resource in a specific language. */
        #[Field(FieldType::STRING, 'flavor_text')]
        public string $flavorText,

        /** @var ProxyEndpoint<Language>|Language $language The language this name is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public ProxyEndpoint|Language $language,
        public string $locale,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group that uses this flavor text. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,
    ) {
    }
}
