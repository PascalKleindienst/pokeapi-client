<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\SuperContestEffectEntityDefinition;
use PokeDB\PokeApiClient\Entities\SuperContestEffect;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class SuperContestEffectEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new SuperContestEffectEntityDefinition();
        $this->assertEquals('super-contest-effect', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new SuperContestEffectEntityDefinition();
        $this->assertEquals(SuperContestEffect::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('super-contest-effect.json');
        $definition = new SuperContestEffectEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var SuperContestEffect $entity */
        $this->assertInstanceOf(SuperContestEffect::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['appeal'], $entity->getAppeal());
        $this->assertEquals($entity->getFlavorTexts()->get('en'), 'Enables the user to perform first in the next turn.');
    }
}
