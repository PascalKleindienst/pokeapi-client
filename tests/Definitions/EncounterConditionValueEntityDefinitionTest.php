<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EncounterConditionValueEntityDefinition;
use PokeDB\PokeApiClient\Entities\EncounterCondition;
use PokeDB\PokeApiClient\Entities\EncounterConditionValue;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class EncounterConditionValueEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new EncounterConditionValueEntityDefinition();
        $this->assertEquals('encounter-condition-value', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new EncounterConditionValueEntityDefinition();
        $this->assertEquals(EncounterConditionValue::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('encounter-condition-value.json');
        $definition = new EncounterConditionValueEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var EncounterConditionValue $entity */
        $this->assertInstanceOf(EncounterConditionValue::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['name'], $entity->getName());
        $this->assertEquals($entity->getNames()->get('en'), 'During a swarm');
        $this->assertInstanceOf(EncounterCondition::class, $entity->getCondition());
    }
}
