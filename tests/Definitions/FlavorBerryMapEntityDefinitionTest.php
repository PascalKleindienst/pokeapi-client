<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\FlavorBerryMapEntityDefinition;
use PokeDB\PokeApiClient\Entities\Berry;
use PokeDB\PokeApiClient\Entities\FlavorBerryMap;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class FlavorBerryMapEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new FlavorBerryMapEntityDefinition();
        $this->assertEquals('', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new FlavorBerryMapEntityDefinition();
        $this->assertEquals(FlavorBerryMap::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('flavor-berry-map.json');
        $definition = new FlavorBerryMapEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var FlavorBerryMap $entity */
        $this->assertInstanceOf(FlavorBerryMap::class, $entity);
        $this->assertEquals($data['potency'], $entity->getPotency());
        $this->assertInstanceOf(Berry::class, $entity->getBerry());
    }
}
