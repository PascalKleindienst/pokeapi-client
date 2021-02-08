<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Definitions;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\ContestEffectEntityDefinition;
use PokeDB\PokeApiClient\Entities\ContestEffect;
use PokeDB\PokeApiClient\Tests\helpers\TestFileLoader;

class ContestEffectEntityDefinitionTest extends TestCase
{
    use TestFileLoader;

    public function testGetEndpoint()
    {
        $definition = new ContestEffectEntityDefinition();
        $this->assertEquals('contest-effect', $definition->getEndpoint());
    }

    public function testGetEntityClass()
    {
        $definition = new ContestEffectEntityDefinition();
        $this->assertEquals(ContestEffect::class, $definition->getEntityClass());
    }

    public function testResolve()
    {
        $data = $this->loadTestJsonFile('contest-effect.json');
        $definition = new ContestEffectEntityDefinition();
        $entity = $definition->resolve($data);

        /** @var ContestEffect $entity */
        $this->assertInstanceOf(ContestEffect::class, $entity);

        $this->assertEquals($data['id'], $entity->getId());
        $this->assertEquals($data['appeal'], $entity->getAppeal());
        $this->assertEquals($data['jam'], $entity->getJam());
        $this->assertEquals($entity->getEffects()->get('en'), 'Gives a high number of appeal points wth no other effects.');
        $this->assertEquals($entity->getFlavorTexts()->get('en'), 'A highly appealing move.');
    }
}
