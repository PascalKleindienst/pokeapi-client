<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests;

use Cache\Adapter\Void\VoidCachePool;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Client;
use PokeDB\PokeApiClient\Definitions\BerryEntityDefinition;
use PokeDB\PokeApiClient\Definitions\BerryFirmnessEntityDefinition;
use PokeDB\PokeApiClient\Definitions\BerryFlavorEntityDefinition;
use PokeDB\PokeApiClient\Definitions\ContestEffectEntityDefinition;
use PokeDB\PokeApiClient\Definitions\ContestTypeEntityDefinition;
use PokeDB\PokeApiClient\Definitions\EncounterConditionEntityDefinition;
use PokeDB\PokeApiClient\Definitions\EncounterConditionValueEntityDefinition;
use PokeDB\PokeApiClient\Definitions\EncounterMethodEntityDefinition;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Definitions\SuperContestEffectEntityDefinition;
use PokeDB\PokeApiClient\Entities\Berry;
use PokeDB\PokeApiClient\Entities\BerryFirmness;
use PokeDB\PokeApiClient\Entities\BerryFlavor;
use PokeDB\PokeApiClient\Entities\ContestEffect;
use PokeDB\PokeApiClient\Entities\ContestType;
use PokeDB\PokeApiClient\Entities\EncounterCondition;
use PokeDB\PokeApiClient\Entities\EncounterConditionValue;
use PokeDB\PokeApiClient\Entities\EncounterMethod;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Entities\SuperContestEffect;
use PokeDB\PokeApiClient\Exceptions\NetworkException;

class ClientTest extends TestCase
{
    /**
     * @group slow
     */
    public function testExceptionIsThrownOnHttpError()
    {
        $definitionMock = $this->createMock(EntityDefinition::class);
        $this->expectException(NetworkException::class);

        $client = new Client('http://example.com');
        $client->sendRequest($definitionMock, '404');
    }

    /**
     * @group slow
     */
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

    public function testBerry()
    {
        // berry() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(BerryEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(Berry::class));

        $client->berry('foo');
    }

    public function testBerryFirmness()
    {
        // berry() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(BerryFirmnessEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(BerryFirmness::class));

        $client->berryFirmness('foo');
    }

    public function testBerryFlavor()
    {
        // berry() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(BerryFlavorEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(BerryFlavor::class));

        $client->berryFlavor('foo');
    }

    public function testContestEffect()
    {
        // contestEffect() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(ContestEffectEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(ContestEffect::class));

        $client->contestEffect('foo');
    }

    public function testContestType()
    {
        // contestType() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(ContestTypeEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(ContestType::class));

        $client->contestType('foo');
    }

    public function testSuperContestEffect()
    {
        // contestEffect() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(SuperContestEffectEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(SuperContestEffect::class));

        $client->superContestEffect('foo');
    }

    public function testEncounterMethod()
    {
        // encounterMethod() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(EncounterMethodEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(EncounterMethod::class));

        $client->encounterMethod('foo');
    }

    public function testEncounterCondition()
    {
        // encounterCondition() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(EncounterConditionEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(EncounterCondition::class));

        $client->encounterCondition('foo');
    }

    public function testEncounterConditionValue()
    {
        // encounterConditionValue() is only a shorthand for sendRequest, so we test if sendRequest is called with the right args
        $client = $this->createPartialMock(Client::class, ['sendRequest']);
        $client
            ->expects($this->exactly(1))
            ->method('sendRequest')
            ->with($this->isInstanceOf(EncounterConditionValueEntityDefinition::class), 'foo')
            ->willReturn($this->createMock(EncounterConditionValue::class));

        $client->encounterConditionValue('foo');
    }
}
