<?php

use PokeDB\PokeApiClient\Api\Api;
use PokeDB\PokeApiClient\Api\ClientInterface;
use Symfony\Component\Cache\Adapter\NullAdapter;

#[\PokeDB\PokeApiClient\Api\Endpoint(\PokeDB\PokeApiClient\Api\Resource::NONE)]
class EntityMock extends \PokeDB\PokeApiClient\Entities\Entity {
    public function __construct(public string $foo){
    }
}

it('will get an entity resource', function() {
    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->method('request')->willReturn(['foo' => 'bar']);

    $client = new Api('', $clientMock, cache: new NullAdapter());
    $result = $client->get(EntityMock::class, '');
    expect($result)->toBeInstanceOf(EntityMock::class)
        ->and($result->foo)->toBe('bar');
});

it('is a singleton', function () {
    $client = new Api('', cache: new NullAdapter());
    expect(Api::getInstance())->toBe($client);
});

it('will get a cached entity resource', function() {
    $cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();

    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->expects($this->once())->method('request')->willReturn(['foo' => 'bar']);
    $client = new Api('', $clientMock, cache: $cache);
    $result = $client->get(EntityMock::class, '');

    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->expects($this->never())->method('request')->willReturn(['foo' => 'updated']);
    $client = new Api('', $clientMock, cache: $cache);
    $resultCached = $client->get(EntityMock::class, '');

    expect($resultCached)->toEqual($result);
});

it('will get the resource list', function() {
    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->method('request')->with('/?limit=1&offset=1')->willReturn([
        'results' => [['foo' => 'bar']], 'previous' => null, 'next' => null, 'count' => 1
    ]);

    $client = new Api('', $clientMock, cache: new NullAdapter());
    $result = $client->all(EntityMock::class, 1, 1);

    expect($result)
        ->and($result->count)->toBe(1)
        ->and($result->results)->toEqual(\PokeDB\PokeApiClient\Utils\ApiResourceCollection::create(EntityMock::class, [['foo' => 'bar']]))
        ->and($result->previous)->toBeNull()
        ->and($result->next)->toBeNull();
});

it('will get the resource list from cache', function() {
    $cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->method('request')->with('/?limit=1&offset=1')->willReturn([
        'results' => [['foo' => 'bar']], 'previous' => null, 'next' => null, 'count' => 1
    ]);

    $clientCacheMock = $this->createMock(ClientInterface::class);
    $clientCacheMock->method('request')->with('/?limit=1&offset=1')->willReturn([
        'results' => [['foo' => 'blub']], 'previous' => null, 'next' => null, 'count' => 1
    ]);

    $result = (new Api('', $clientMock, cache: $cache))->all(EntityMock::class, 1, 1);
    $resultCached = (new Api('', $clientCacheMock, cache: $cache))->all(EntityMock::class, 1, 1);

    expect($resultCached)->toEqual($result);
});

it('will not get the resource list from cache if the pagination differs', function() {
    $cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
    $clientMock = $this->createMock(ClientInterface::class);
    $clientMock->method('request')->with('/?limit=1&offset=1')->willReturn([
        'results' => [['foo' => 'bar']], 'previous' => null, 'next' => null, 'count' => 1
    ]);

    $clientCacheMock = $this->createMock(ClientInterface::class);
    $clientCacheMock->method('request')->with('/?limit=10&offset=1')->willReturn([
        'results' => [['foo' => 'blub']], 'previous' => null, 'next' => null, 'count' => 1
    ]);

    $result = (new Api('', $clientMock, cache: $cache))->all(EntityMock::class, 1, 1);
    $resultCached = (new Api('', $clientCacheMock, cache: $cache))->all(EntityMock::class, 10, 1);

    expect($resultCached)->not()->toEqual($result);
});

it('throw a type error for an invalid entity', function() {
    (new Api('', cache: new NullAdapter()))->get('does_not_exist', '');
})->throws(TypeError::class);