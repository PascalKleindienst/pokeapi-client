<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Utils;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Utils\Collection;

class CollectionTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGet($data)
    {
        $collection = new Collection($data);

        foreach ($data as $key => $expected) {
            $this->assertEquals($expected, $collection->get($key));
        }
    }

    public function testGetInvalid()
    {
        $collection = new Collection();

        $this->assertNull($collection->get('unknown'));
    }

    /**
     * @depends testGet
     * @dataProvider dataProvider
     */
    public function testAdd($data)
    {
        $collection = new Collection();

        foreach ($data as $key => $expected) {
            $collection->add($expected);
            $this->assertEquals($expected, $collection->get($key));
        }
    }

    /**
     * @depends testGet
     * @dataProvider dataProvider
     */
    public function testSet($data)
    {
        $collection = new Collection();

        foreach ($data as $key => $expected) {
            $collection->set(null, $expected);
            $this->assertEquals($expected, $collection->get($key));
        }
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCount($data)
    {
        $collection = new Collection($data);
        $this->assertCount(\count($data), $collection);
    }

    /**
     * @depends testCount
     * @dataProvider dataProvider
     */
    public function testClear($data)
    {
        $collection = new Collection($data);
        $collection->clear();
        $this->assertCount(0, $collection);
    }

    /**
     * @depends testCount
     * @dataProvider dataProvider
     */
    public function testGetKey($data)
    {
        $collection = new Collection($data);
        $this->assertEquals(array_keys($data), $collection->getKeys());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testJsonSerialize($data)
    {
        $collection = new Collection($data);
        $this->assertEquals(json_encode($data), json_encode($collection));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testToArray($data)
    {
        $collection = new Collection($data);
        $this->assertEquals($data, $collection->toArray());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFirst($data)
    {
        $collection = new Collection($data);
        $this->assertEquals($data[0], $collection->first());
    }

    public function testFirstEmpty()
    {
        $collection = new Collection();
        $this->assertNull($collection->first());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testLast($data)
    {
        $collection = new Collection($data);
        $this->assertEquals(array_reverse($data)[0], $collection->last());
    }

    public function testLastEmpty()
    {
        $collection = new Collection();
        $this->assertNull($collection->last());
    }

    /**
     * @depends testGet
     * @dataProvider dataProvider
     */
    public function testRemove($data)
    {
        $collection = new Collection($data);
        $this->assertEquals($data[1], $collection->get(1));
        $collection->remove(1);
        $this->assertNull($collection->get(1));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testIterator($data)
    {
        $collection = new Collection($data);

        foreach ($collection as $key => $item) {
            $this->assertEquals($data[$key], $item);
        }
    }

    public function dataProvider()
    {
        return [
            [['a', 'b', 'c']]
        ];
    }
}
