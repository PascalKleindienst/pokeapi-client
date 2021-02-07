<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\BerryFirmnessEntityDefinition;
use PokeDB\PokeApiClient\Entities\Berry;
use PokeDB\PokeApiClient\Entities\BerryFirmness;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class BerryFirmnessEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new BerryFirmnessEntityDefinition();
        $this->assertEquals('berry-firmness', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new BerryFirmnessEntityDefinition();
        $this->assertEquals(BerryFirmness::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $berry = $this->loadTestJsonFile('berry-firmness.json');
        $definition = new BerryFirmnessEntityDefinition();
        $entity = $definition->resolve($berry);

        /** @var BerryFirmness $entity */
        $this->assertInstanceOf(BerryFirmness::class, $entity);

        $this->assertEquals($berry['id'], $entity->getId());
        $this->assertEquals($berry['name'], $entity->getName());
        $this->assertEquals($entity->getNames()->get('fr'), 'Très tendre');
        $this->assertEquals($entity->getNames()->get('en'), 'Very Soft');

        foreach ($entity->getBerries() as $berry) {
            $this->assertInstanceOf(Berry::class, $berry);
        }
    }
}
