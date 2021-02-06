<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Fields\StringField;

class StringFieldTest extends TestCase
{
    public function testResolve()
    {
        $field = new StringField('property', 'storage');
        $this->assertEquals('foo', $field->resolve(['storage' => 'foo']));
        $this->assertEquals('1', $field->resolve(['storage' => 1]));
        $this->assertEquals('', $field->resolve(['storage' => null]));
        $this->assertEquals('1', $field->resolve(['storage' => true]));
        $this->assertEquals('', $field->resolve(['storage' => false]));
    }
}
