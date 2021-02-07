<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\BerryFlavorEntityDefinition;
use PokeDB\PokeApiClient\Entities\Berry;
use PokeDB\PokeApiClient\Entities\BerryFlavor;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class BerryFlavorEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new BerryFlavorEntityDefinition();
        $this->assertEquals('berry-flavor', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new BerryFlavorEntityDefinition();
        $this->assertEquals(BerryFlavor::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('berry-flavor.json');
        $definition = new BerryFlavorEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var BerryFlavor $entity */
        $this->assertInstanceOf(BerryFlavor::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['name'], $entity->getName());
        $this->assertEquals($entity->getNames()->get('fr'), 'Épicé');
        $this->assertEquals($entity->getNames()->get('en'), 'Spicy');

        foreach ($entity->getBerries() as $key => $berry) {
            $this->assertEquals($data['berries'][$key]['potency'], $berry->getPotency());
            $this->assertInstanceOf(Berry::class, $berry->getBerry());
        }
    }
}
