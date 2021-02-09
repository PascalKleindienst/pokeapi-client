<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EncounterConditionEntityDefinition;
use PokeDB\PokeApiClient\Entities\EncounterCondition;
use PokeDB\PokeApiClient\Entities\EncounterConditionValue;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class EncounterConditionEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new EncounterConditionEntityDefinition();
        $this->assertEquals('encounter-condition', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new EncounterConditionEntityDefinition();
        $this->assertEquals(EncounterCondition::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('encounter-condition.json');
        $definition = new EncounterConditionEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var EncounterCondition $entity */
        $this->assertInstanceOf(EncounterCondition::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['name'], $entity->getName());
        $this->assertEquals($entity->getNames()->get('en'), 'Swarm');

        foreach ($entity->getValues() as $key => $value) {
            $this->assertInstanceOf(EncounterConditionValue::class, $value);
        }
    }
}
