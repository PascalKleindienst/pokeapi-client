<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Fields\ObjectField;

class ObjectFieldTest extends TestCase
{
    public function testResolve()
    {
        $definitionMock = $this->getMockForAbstractClass(EntityDefinition::class, [], '', true, true, true, ['resolve']);
        $definitionMock->expects($this->exactly(1))->method('resolve')->with(['foo' => 'bar']);

        $field = $this->getMockBuilder(ObjectField::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(['props', 'storage', get_class($definitionMock)])
            ->onlyMethods(['createDefinition'])
            ->getMock();
        $field->method('createDefinition')->willReturn($definitionMock);

        $field->resolve(['storage' => ['foo' => 'bar']]);
    }
}
