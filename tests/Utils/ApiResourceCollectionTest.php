<?php

use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Utils\ApiResourceCollection;

class MockEntity extends Entity {}

it('can be created', function () {
    $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
    expect($collection)->toBeInstanceOf(ApiResourceCollection::class);
});

it('can get the foreign keys', function () {
    $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
    expect($collection->getForeignKeys())->toEqual(['foo']);
});

it('can check if a lazy loaded key exists', function () {
    $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
    expect($collection->has(0))->toBeTrue();
});

it('can check if a key exists', function () {
    $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
    $collection->add('foo');
    expect($collection->has(0))->toBeTrue()->and($collection->get(0))->toBe('foo');
});

it('can count the lazy loaded elements', function () {
    $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
    expect($collection->count())->toBe(1);
});

// it('can get the first lazy element', function () {
//     $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
//     expect($collection->first())->toBe(['name' => 'foo', 'url' => 'bar']);
// });
//
// it('can get the last lazy element', function () {
//     $collection = ApiResourceCollection::create(MockEntity::class, [['name' => 'foo', 'url' => 'bar']]);
//     expect($collection->last())->toBe(['name' => 'foo', 'url' => 'bar']);
// });