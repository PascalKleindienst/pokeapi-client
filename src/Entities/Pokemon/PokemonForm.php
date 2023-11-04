<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\ProxyEndpoint;
use PokeDB\PokeApiClient\Api\Resource;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Games\VersionGroup;
use PokeDB\PokeApiClient\Entities\Utility\Name;
use PokeDB\PokeApiClient\Entities\Utility\Sprite;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;

/**
 * Some Pokémon may appear in one of multiple, visually different forms.
 *
 * These differences are purely cosmetic. For variations within a Pokémon species,
 * which do differ in more than just visuals, the 'Pokémon' entity is used to represent such a variety.
 *
 * @see https://pokeapi.co/docs/v2#pokemonform
 */
#[Endpoint(Resource::POKEMON_FORM)]
final readonly class PokemonForm extends Entity
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

        /** @var int $order The order in which forms should be sorted within all forms. Multiple forms may have equal order, in which case they should fall back on sorting by name. */
        #[Field(FieldType::NUMBER)]
        public int $order,

        /** @var int $formOrder The order in which forms should be sorted within a species' forms. */
        #[Field(FieldType::NUMBER, apiName: 'form_order')]
        public int $formOrder,

        /** @var bool $isDefault True for exactly one form used as the default for each Pokémon. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_default')]
        public bool $isDefault,

        /** @var bool $isBattleOnly Whether or not this form can only happen during battle. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_battle_only')]
        public bool $isBattleOnly,

        /** @var bool $isMega Whether or not this form requires mega evolution. */
        #[Field(FieldType::BOOLEAN, apiName: 'is_mega')]
        public bool $isMega,

        /** @var ?string $formName The name of this form. */
        #[Field(FieldType::STRING, apiName: 'form_name')]
        public ?string $formName,

        /** @var ProxyEndpoint<Pokemon>|Pokemon $pokemon The Pokémon that can take on this form. */
        #[Field(FieldType::NAMED_API_RESOURCE, definition: Pokemon::class)]
        public ProxyEndpoint|Pokemon $pokemon,

        /** @var Collection<PokemonFormType> $types A list of details showing types this Pokémon form has. */
        #[Field(FieldType::COLLECTION, definition: PokemonFormType::class)]
        public Collection $types,

        /** @var Sprite $sprites A set of sprites used to depict this Pokémon form in the game. */
        #[Field(FieldType::ENTITY, definition: Sprite::class)]
        public Sprite $sprites,

        /** @var ProxyEndpoint<VersionGroup>|VersionGroup $versionGroup The version group this Pokémon form was introduced in. */
        #[Field(FieldType::NAMED_API_RESOURCE, apiName: 'version_group', definition: VersionGroup::class)]
        public ProxyEndpoint|VersionGroup $versionGroup,

        /** @var Collection<Name> $names The form specific full name of this Pokémon form, or empty if the form does not have a specific name. */
        #[Field(FieldType::TRANSLATION, definition: Name::class)]
        public Collection $names,

        /** @var Collection<Name> $formNames The form specific form name of this Pokémon form, or empty if the form does not have a specific name. */
        #[Field(FieldType::TRANSLATION, apiName: 'form_names', definition: Name::class)]
        public Collection $formNames,
    ) {
    }
}
