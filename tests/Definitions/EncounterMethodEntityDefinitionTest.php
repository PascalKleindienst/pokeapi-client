<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EncounterMethodEntityDefinition;
use PokeDB\PokeApiClient\Entities\EncounterMethod;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class EncounterMethodEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new EncounterMethodEntityDefinition();
        $this->assertEquals('encounter-method', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new EncounterMethodEntityDefinition();
        $this->assertEquals(EncounterMethod::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('encounter-method.json');
        $definition = new EncounterMethodEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var EncounterMethod $entity */
        $this->assertInstanceOf(EncounterMethod::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['name'], $entity->getName());
        $this->assertEquals($data['order'], $entity->getOrder());
        $this->assertEquals($entity->getNames()->get('en'), 'Walking in tall grass or a cave');
    }
}
