<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\NamedAPIResourceListField;
use PokeDB\PokeApiClient\Utils\ClientInterface;

class NamedAPIResourceListFieldTest extends TestCase
{
    public function testResolveProxyToEntity()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $definitionMock = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['getEntityClass', 'getClient']);
        $definitionMock->method('getEntityClass')->willReturn(get_class($this->createMock(Entity::class)));
        $definitionMock->method('getClient')->willReturn($clientMock);

        // checks that we actually try to resolve the proxy!
        $clientMock->expects($this->exactly(2))->method('sendRequest')->withConsecutive(
            [$definitionMock, 'foo'],
            [$definitionMock, 'bar']
        );

        // Mock Field to create definition mock
        $field = $this->getMockBuilder(NamedAPIResourceListField::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(['props', 'storage', get_class($definitionMock)])
            ->onlyMethods(['createDefinition'])
            ->getMock();
        $field->method('createDefinition')->willReturn($definitionMock);

        // Resolve Field
        $response = $field->resolve([
            'storage' => [
                [
                    'name' => 'foo',
                    'url' => 'https://example.com'
                ],
                [
                    'name' => 'bar',
                    'url' => 'https://example.com'
                ],
            ],
        ], $clientMock);

        foreach ($response as $item) {
            $item->has('some-property');
        }
    }
}
