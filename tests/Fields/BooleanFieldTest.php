<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Fields\BooleanField;

class BooleanFieldTest extends TestCase
{
    public function testResolve()
    {
        $field = new BooleanField('property', 'storage');
        $this->assertTrue($field->resolve(['storage' => 1]));
        $this->assertFalse($field->resolve(['storage' => false]));
    }
}
