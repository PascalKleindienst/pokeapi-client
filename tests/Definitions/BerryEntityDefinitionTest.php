<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\BerryEntityDefinition;
use PokeDB\PokeApiClient\Entities\Berries\Berry;
use PokeDB\PokeApiClient\Entities\Berries\BerryFirmness;
use PokeDB\PokeApiClient\Entities\Berries\BerryFlavor;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class BerryEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new BerryEntityDefinition();
        $this->assertEquals('berry', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new BerryEntityDefinition();
        $this->assertEquals(Berry::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $berry = $this->loadTestJsonFile('berry.json');
        $definition = new BerryEntityDefinition();
        $entity = $definition->resolve($berry);

        /** @var Berry $entity */
        $this->assertInstanceOf(Berry::class, $entity);

        $this->assertEquals($berry['id'], $entity->getId());
        $this->assertEquals($berry['name'], $entity->getName());
        $this->assertEquals($berry['growth_time'], $entity->getGrowthTime());
        $this->assertEquals($berry['max_harvest'], $entity->getMaxHarvest());
        $this->assertEquals($berry['natural_gift_power'], $entity->getNaturalGiftPower());
        $this->assertEquals($berry['size'], $entity->getSize());
        $this->assertEquals($berry['smoothness'], $entity->getSmoothness());
        $this->assertEquals($berry['soil_dryness'], $entity->getSoilDryness());
        $this->assertInstanceOf(BerryFirmness::class, $entity->getFirmness());

        foreach ($entity->getFlavors() as $key => $flavor) {
            $this->assertEquals($berry['flavors'][$key]['potency'], $flavor->getPotency());
            $this->assertInstanceOf(BerryFlavor::class, $flavor->getFlavor());
        }
    }
}
