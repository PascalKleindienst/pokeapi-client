<?php

use PokeDB\PokeApiClient\Utils\Collection;

it('can get an element from the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    expect($collection->get('foo'))->toBe('bar');
});

it('can add an element to the collection', function () {
    $collection = new Collection();
    $collection->add('foo');
    expect($collection->get(0))->toBe('foo');
});

it('can set an element in the collection', function () {
    $collection = new Collection();
    $collection->set('foo', 'bar');
    expect($collection->get('foo'))->toBe('bar');
});

it('can set an element in the collection without an index', function () {
    $collection = new Collection();
    $collection->set(null, 'foo');
    expect($collection->get(0))->toBe('foo');
});

it('can remove an element from the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    $collection->remove('foo');
    expect($collection->get('foo'))->toBeNull();
});

it('can check if an element exists in the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    expect($collection->has('foo'))->toBeTrue()
        ->and($collection->has('bar'))->toBeFalse();
});

it('can count the number of elements in the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    expect($collection->count())->toBe(1);
});

it('can get the keys of the collection elements', function () {
    $collection = new Collection(['foo' => 'bar']);
    expect($collection->getKeys())->toEqual(['foo']);
});

it('can clear the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    $collection->clear();
    expect($collection->count())->toBe(0);
});

it('can iterate over the collection', function () {
    $collection = new Collection(['foo' => 'bar']);
    $collection->each(function ($item) {
        expect($item)->toBe('bar');
    });
});

it('can convert the collection to an array', function () {
    $collection = new Collection(['foo' => 'bar']);
    expect($collection->all())->toEqual(['foo' => 'bar']);
});

it('can get the first element in the collection', function () {
    $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
    expect($collection->first())->toBe('bar');
});

it('can get the last element in the collection', function () {
    $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
    expect($collection->last())->toBe('qux');
});

it('can group the collection by a column', function () {
    $collection = new Collection([['foo' => 'bar', 'qux' => 'barfoo'], ['foo' => 'baz', 'qux' => 'foobar']]);
    expect($collection->groupBy('foo'))->toEqual(
        new Collection(['bar' => [['foo' => 'bar', 'qux' => 'barfoo']], 'baz' => [['foo' => 'baz', 'qux' => 'foobar']]])
    );
});

it('can pluck the collection by a column', function () {
    $collection = new Collection([['foo' => 'bar', 'qux' => 'barfoo'], ['foo' => 'baz', 'qux' => 'foobar']]);
    expect($collection->pluck('foo'))->toEqual(new Collection(['bar', 'baz']));
});

it('can pluck the collection by a column and index', function () {
    $collection = new Collection([['foo' => 'bar', 'qux' => 'barfoo'], ['foo' => 'baz', 'qux' => 'foobar']]);
    expect($collection->pluck('foo', 'qux'))->toEqual(new Collection(['barfoo' => 'bar', 'foobar' => 'baz']));
});

it('can map the collection', function () {
    $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
    expect($collection->map(fn ($item) => strtoupper($item)))->toEqual(new Collection(['foo' => 'BAR', 'baz' => 'QUX']));
});

it('can filter the collection', function () {
    $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
    expect($collection->filter(fn ($item) => $item !== 'bar'))->toEqual(new Collection(['baz' => 'qux']));
});

it('can serialize the collection', function () {
    $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
    expect($collection->jsonSerialize())->toEqual(['foo' => 'bar', 'baz' => 'qux']);
});