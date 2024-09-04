<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Contests;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Language;
use PokeDB\PokeApiClient\Entities\Utility\Translateable;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

final class ContestName extends Entity implements Translateable
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var string $name The name for this resource. */
        #[Field(FieldType::STRING)]
        public string $name,

        /** @var string $color The color associated with this contest's name. */
        #[Field(FieldType::STRING)]
        public string $color,

        /** @var Language $language The language this name is in. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Language::class)]
        public Language $language,
        public string $locale
    ) {
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
