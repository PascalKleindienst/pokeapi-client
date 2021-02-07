<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\BerryFlavorMapEntityDefinition;
use PokeDB\PokeApiClient\Entities\BerryFlavor;
use PokeDB\PokeApiClient\Entities\BerryFlavorMap;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class BerryFlavorMapEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new BerryFlavorMapEntityDefinition();
        $this->assertEquals('', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new BerryFlavorMapEntityDefinition();
        $this->assertEquals(BerryFlavorMap::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('berry-flavor-map.json');
        $definition = new BerryFlavorMapEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var BerryFlavorMap $entity */
        $this->assertInstanceOf(BerryFlavorMap::class, $entity);
        $this->assertEquals($data['potency'], $entity->getPotency());
        $this->assertInstanceOf(BerryFlavor::class, $entity->getFlavor());
    }
}
