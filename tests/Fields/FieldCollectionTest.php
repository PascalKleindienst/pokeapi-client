<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Utils;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Fields\Field;
use PokeDB\PokeApiClient\Fields\FieldCollection;

class FieldCollectionTest extends TestCase
{
    public function testExpectedClass()
    {
        $this->expectException(InvalidArgumentException::class);
        new FieldCollection(['a']);
    }

    public function testExpectedClassWorking()
    {
        new FieldCollection([$this->createMock(Field::class)]);
        $this->assertTrue(true);
    }
}
