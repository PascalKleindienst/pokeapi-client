<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Utils;

use DateTime;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Utils\Struct;

class StructTest extends TestCase
{
    public function testGetVars()
    {
        $stub = new class extends Struct
        {
            public $foo;
        };

        $stub->foo = 'bar';
        $props = $stub->getVars();

        $this->assertArrayHasKey('foo', $props);
        $this->assertEquals('bar', $props['foo']);
    }

    public function testJsonSerialize()
    {
        $stub = new class extends Struct
        {
            public $foo;
        };

        $stub->foo = 'bar';

        $this->assertSame('{"foo":"bar"}', json_encode($stub));
    }

    /**
     * @depends testJsonSerialize
     */
    public function testJsonSerializeDate()
    {
        $stub = new class extends Struct
        {
            public $foo;
        };

        $stub->foo = (new DateTime())->setTimestamp(0);

        $this->assertSame('{"foo":"1970-01-01T00:00:00.000+00:00"}', json_encode($stub));
    }
}
