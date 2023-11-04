<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Pokemon;

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\Utility\Sprite;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;

/**
 * @see https://pokeapi.co/docs/v2#pokemonsprites
 */
final readonly class PokemonSpritesOther extends Entity
{
    /**
     * phpcs:disable Squiz.Functions.MultiLineFunctionDeclaration.EmptyLine
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        /** @var Sprite $dreamWorld Dream World Sprites */
        #[Field(FieldType::ENTITY, apiName: 'dream_world', definition: Sprite::class)]
        public Sprite $dreamWorld,

        /** @var Sprite $home Pokemon Home Sprites */
        #[Field(FieldType::ENTITY, definition: Sprite::class)]
        public Sprite $home,

        /** @var Sprite $showdown Showdown GIFs */
        #[Field(FieldType::ENTITY, definition: Sprite::class)]
        public Sprite $showdown,

        /** @var Sprite $officialArtwork Official Artwork */
        #[Field(FieldType::ENTITY, apiName: 'official-artwork', definition: Sprite::class)]
        public Sprite $officialArtwork,
    ) {
    }
}