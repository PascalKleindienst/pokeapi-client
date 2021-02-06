<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\ArrayField;
use PokeDB\PokeApiClient\Utils\Collection;

class ArrayFieldTest extends TestCase
{
    public function testResolve()
    {
        $entity = new class extends Entity
        {
            public $foo;
        };

        $collectionMock = $this->createMock(Collection::class);
        $collectionMock->expects($this->exactly(2))->method('add')->with($entity);

        $definitionMock = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['resolve', 'createEntityCollection']);
        $definitionMock->method('createEntityCollection')->willReturn($collectionMock);
        $definitionMock->method('resolve')->willReturn($entity);

        $field = $this->getMockBuilder(ArrayField::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(['props', 'storage', get_class($definitionMock)])
            ->onlyMethods(['createDefinition'])
            ->getMock();
        $field->method('createDefinition')->willReturn($definitionMock);

        $field->resolve(['storage' => [['foo' => 'bar'], ['foo' => 'baz']]]);
    }
}
