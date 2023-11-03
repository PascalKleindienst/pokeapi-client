<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Languages for translations of API resource information.
 *
 * @see https://pokeapi.co/docs/v2#languages
 */
#[Endpoint(Resource::LANGUAGE)]
final readonly class Language extends Entity
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

        /** @var bool $official Whether or not the games are published in this language. */
        #[Field(FieldType::BOOLEAN)]
        public bool $official,

        /** @var string $iso639 The two-letter code of the country where this language is spoken. Note that it is not unique. */
        #[Field(FieldType::STRING)]
        public string $iso639,

        /** @var string $iso3166 The two-letter code of the language. Note that it is not unique. */
        #[Field(FieldType::STRING)]
        public string $iso3166,

        /** @var Collection<Name> $names The name of this resource listed in different languages. */
        #[Field(FieldType::COLLECTION, definition: Name::class)]
        public Collection $names,
    ) {
    }
}
