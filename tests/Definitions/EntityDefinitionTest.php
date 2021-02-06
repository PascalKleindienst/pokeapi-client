<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\Field;
use PokeDB\PokeApiClient\Fields\FieldCollection;
use PokeDB\PokeApiClient\Utils\ClientInterface;
use PokeDB\PokeApiClient\Utils\Collection;
use ReflectionProperty;
use stdClass;

class EntityDefinitionTest extends TestCase
{
    public function testSetClient()
    {
        $definition = $this->getMockForAbstractClass(EntityDefinition::class);
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $this->assertEquals($definition, $definition->setClient($client));
    }

    /**
     * @depends testSetClient
     */
    public function testGetClient()
    {
        $definition = $this->getMockForAbstractClass(EntityDefinition::class);
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $definition->setClient($client);

        $this->assertEquals($client, $definition->getClient());
    }

    public function testGetEntityCollection()
    {
        $definition = $this->getMockForAbstractClass(EntityDefinition::class);
        $this->assertEquals(Collection::class, $definition->getEntityCollection());
    }

    public function testCrreateEntityCollection()
    {
        $definition = $this->getMockForAbstractClass(EntityDefinition::class);
        $this->assertInstanceOf(Collection::class, $definition->createEntityCollection());
    }

    public function testCrreateEntityCollectionFailing()
    {
        $definition = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['getEntityCollection']);
        $definition->method('getEntityCollection')->willReturn(stdClass::class);
        $this->expectException(InvalidArgumentException::class);
        $definition->createEntityCollection();
    }

    public function testResolve()
    {
        $collectionMock =  $this->getMockBuilder(FieldCollection::class)->getMock();
        $collectionMock->method('getIterator')->willReturn((function () {
            $mock = $this->getMockForAbstractClass(Field::class, ['foo']);
            $mock->method('resolve')->willReturn('bar');
            yield $mock;
        })());

        $entityMock = $this->initEntity();


        $definition = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['defineFields']);
        $definition->method('defineFields')->willReturn($collectionMock);
        $definition->method('getEntityClass')->willReturn(
            get_class($entityMock)
        );

        $entity = $definition->resolve(['foo' => 'bar']);
        $this->assertEquals('bar', $entity->foo);
    }

    private function initEntity()
    {
        return new class extends Entity
        {
            public $foo;
        };
    }
}
