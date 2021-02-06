<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Fields\NumberField;

class NumberFieldTest extends TestCase
{
    public function testResolve()
    {
        $field = new NumberField('property', 'storage');
        $this->assertEquals(1, $field->resolve(['storage' => '1']));
        $this->assertEquals(1, $field->resolve(['storage' => 1]));
        $this->assertEquals(1.2, $field->resolve(['storage' => 1.2]));
        $this->assertEquals(1.2, $field->resolve(['storage' => (float) 1.2]));
        $this->assertEquals(1.2, $field->resolve(['storage' => (float) 1.2]));
    }
}
