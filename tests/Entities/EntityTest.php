<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Entities;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Entities\Entity;

class EntityTest extends TestCase
{
    public function testGet()
    {
        $entity = $this->initEntity();
        $this->assertEquals('bar', $entity->get('foo'));
    }

    public function testGetInvalid()
    {
        $entity = $this->initEntity();
        $this->expectException(InvalidArgumentException::class);
        $entity->get('invalid');
    }

    private function initEntity()
    {
        return new class extends Entity
        {
            protected $foo = 'bar';
        };
    }
}
