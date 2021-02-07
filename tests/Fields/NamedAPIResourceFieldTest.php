<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceField;
use PokeDB\PokeApiClient\Utils\ClientInterface;
use ProxyManager\Proxy\VirtualProxyInterface;
use stdClass;

class NamedAPIResourceFieldTest extends TestCase
{
    public function testResolveProxy()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $definitionMock = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['resolve', 'getEntityClass']);
        $definitionMock->method('getEntityClass')->willReturn(stdClass::class);

        $field = $this->getMockBuilder(NamedAPIResourceField::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(['props', 'storage', get_class($definitionMock)])
            ->onlyMethods(['createDefinition'])
            ->getMock();
        $field->method('createDefinition')->willReturn($definitionMock);

        $response = $field->resolve([
            'storage' => [
                'name' => 'foobar',
                'url' => 'https://example.com'
            ],
        ], $clientMock);

        $this->assertInstanceOf(VirtualProxyInterface::class, $response);
    }

    public function testResolveProxyToEntity()
    {
        $definitionMock = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['getEntityClass', 'getClient']);
        $definitionMock->method('getEntityClass')->willReturn(get_class($this->createMock(Entity::class)));

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects($this->exactly(1))->method('sendRequest')->with($definitionMock, 'foobar'); // checks that we actually try to resolve the proxy!

        $definitionMock->method('getClient')->willReturn($clientMock);

        $field = $this->getMockBuilder(NamedAPIResourceField::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(['props', 'storage', get_class($definitionMock)])
            ->onlyMethods(['createDefinition'])
            ->getMock();
        $field->method('createDefinition')->willReturn($definitionMock);

        $response = $field->resolve([
            'storage' => [
                'name' => 'foobar',
                'url' => 'https://example.com'
            ],
        ], $clientMock);

        $response->has('some-property');
    }
}
