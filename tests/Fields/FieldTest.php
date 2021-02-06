<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Fields\Field;
use ReflectionMethod;

class FieldTest extends TestCase
{
    public function testGetPropertyName()
    {
        $field = $this->getMockForAbstractClass(Field::class, ['property']);
        $this->assertEquals('property', $field->getPropertyName());
    }

    public function testGetStorageName()
    {
        $field = $this->getMockForAbstractClass(Field::class, ['property', 'storage']);
        $this->assertEquals('storage', $field->getStorageName());
    }

    public function testGetDataStorageValue()
    {
        $field = $this->getMockForAbstractClass(Field::class, ['property', 'foo']);
        $method = new ReflectionMethod($field, 'getDataStorageValue');
        $method->setAccessible(true);

        $this->assertEquals('bar', $method->invoke($field, ['foo' => 'bar']));
    }

    public function testGetDataStorageValueInvalid()
    {
        $field = $this->getMockForAbstractClass(Field::class, ['property', 'invalid']);
        $method = new ReflectionMethod($field, 'getDataStorageValue');
        $method->setAccessible(true);

        $this->expectException(InvalidArgumentException::class);
        $method->invoke($field, ['foo' => 'bar']);
    }
}
