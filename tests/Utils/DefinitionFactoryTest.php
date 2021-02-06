<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Utils;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Utils\DefinitionFactory;

class DefinitionFactoryTest extends TestCase
{
    public function testCreateDefinition()
    {
        $definitionMock = $this->createMock(EntityDefinition::class);
        $factoryMock = $this->getMockForTrait(DefinitionFactory::class);
        $this->assertEquals($definitionMock, $factoryMock->createDefinition(get_class($definitionMock), null));
    }

    public function testCreateDefinitionWithInvalidClass()
    {
        $factoryMock = $this->getMockForTrait(DefinitionFactory::class);
        $this->expectException(InvalidArgumentException::class);
        $factoryMock->createDefinition('foobar', null);
    }
}
