<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\ContestTypeEntityDefinition;
use PokeDB\PokeApiClient\Entities\BerryFlavor;
use PokeDB\PokeApiClient\Entities\ContestType;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class ContestTypeEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new ContestTypeEntityDefinition();
        $this->assertEquals('contest-type', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new ContestTypeEntityDefinition();
        $this->assertEquals(ContestType::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('contest-type.json');
        $definition = new ContestTypeEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var ContestType $entity */
        $this->assertInstanceOf(ContestType::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['name'], $entity->getName());
        $this->assertEquals($entity->getNames()->get('fr'), 'Sang-froid');
        $this->assertEquals($entity->getNames()->get('en'), 'Cool');
        $this->assertEquals($entity->getColors()->get('fr'), 'Rouge');
        $this->assertEquals($entity->getColors()->get('en'), 'Red');
        $this->assertInstanceOf(BerryFlavor::class, $entity->getBerryFlavor());
    }
}
