<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests;

use Cache\Adapter\Void\VoidCachePool;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Client;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Exceptions\NetworkException;

class ClientTest extends TestCase
{
    public function testExceptionIsThrownOnHttpError()
    {
        $definitionMock = $this->createMock(EntityDefinition::class);
        $this->expectException(NetworkException::class);

        $client = new Client('http://example.com');
        $client->sendRequest($definitionMock, '404');
    }

    public function testExceptionIsThrownOnCurlError()
    {
        $definitionMock = $this->createMock(EntityDefinition::class);
        $this->expectException(NetworkException::class);

        $client = new Client('http://404.php.net');
        $client->sendRequest($definitionMock, '');
    }

    public function testSendRequest()
    {
        $definitionMock = $this->createMock(EntityDefinition::class);
        $definitionMock->method('resolve')->willReturnCallback(function ($args) {
            $this->assertIsArray($args);
            return $this->createMock(Entity::class);
        });

        $client = new Client(Client::API_ENDPOINT, new VoidCachePool());
        $client->sendRequest($definitionMock, '');
    }

    public function testSendRequestCached()
    {
        $cache = null;
        $definitionMock = $this->createMock(EntityDefinition::class);
        $definitionMock->method('resolve')->willReturnCallback(function ($args) use (&$cache) {
            if ($cache != null) {
                $this->assertEquals($cache, $args);
                return $this->createMock(Entity::class);
            }

            $cache = $args;
            return $this->createMock(Entity::class);
        });

        $client = new Client(Client::API_ENDPOINT);
        $client->sendRequest($definitionMock, '');
        $client->sendRequest($definitionMock, '');
    }
}
