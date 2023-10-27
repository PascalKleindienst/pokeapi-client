<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Api;

enum Resource: string
{
    case ABILITY = 'ability';
    case BERRY = 'berry';
    case BERRY_FIRMNESS = 'berry-firmness';
    case BERRY_FLAVOR = 'berry-flavor';
    case CONTEST_TYPE = 'contest-type';
    case CONTEST_EFFECT = 'contest-effect';
    case SUPER_CONTEST_EFFECT = 'super-contest-effect';
    case ENCOUNTER = 'encounters';
    case ENCOUNTER_CONDITION = 'encounter-condition';
    case ENCOUNTER_CONDITION_VALUE = 'encounter-condition-value';
    case EVOLUTION_CHAIN = 'evolution-chain';
    case EVOLUTION_TRIGGER = 'evolution-trigger';
    case GENERATION = 'generation';
    case POKEDEX = 'pokedex';
    case VERSION = 'version';
    case VERSION_GROUP = 'version-group';
    case ITEM = 'item';
    case ITEM_ATTRIBUTE = 'item-attribute';
    case ITEM_CATEGORY = 'item-category';
    case ITEM_FLING_EFFECT = 'item-fling-effect';
    case ITEM_POKET = 'item-pocket';
    case LOCATION = 'location';
    case LOCATION_AREA = 'location-area';
    case PAL_PARK_AREA = 'pal-park-area';
    case REGION = 'region';
    case MACHINE = 'machine';
    case MOVE = 'move';
    case MOVE_AILMENT = 'move-ailment';
    case MOVE_BATTLE_STYLE = 'move-battle-style';
    case MOVE_CATEGORY = 'move-category';
    case MOVE_DAMAGE_CLASS = 'move-damage-class';
    case MOVE_LEARN_METHOD = 'move-learn-method';
    case MOVE_TARGET = 'move-target';
    case LANGUAGE = 'language';
    case POKEMON = 'pokemon';
    case CHARACTERISTIC = 'characteristic';
    case EGG_GROUP = 'egg-group';
    case GENDER = 'gender';
    case GROWTH_RATE = 'growth-rate';
    case NATURE = 'nature';
    case POKEATHLON_STAT = 'pokeathlon-stat';
    case POKEMON_LOCATION_AREA = 'pokemon/%s/encounters';
    case POKEMON_COLOR = 'pokemon-color';
    case POKEMON_FORM = 'pokemon-form';
    case POKEMON_HABITAT = 'pokemon-habitat';
    case POKEMON_SHAPE = 'pokemon-shape';
    case POKEMON_SPECIES = 'pokemon-species';
    case STAT = 'stat';
    case TYPE = 'type';
}
