<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use PokeDB\PokeApiClient\Fields\TranslatedField;
use PokeDB\PokeApiClient\Utils\Collection;

class TranslatedFieldTest extends TestCase
{
    public function testResolve()
    {
        $field = new TranslatedField('property', 'storage', 'translatedAttr');

        $translations = $field->resolve([
            'storage' => [
                ['translatedAttr' => 'translated de', 'language' => ['name' => 'de']],
                ['translatedAttr' => 'translated en', 'language' => ['name' => 'en']]
            ]
        ]);

        $this->assertInstanceOf(Collection::class, $translations);
        $this->assertEquals('translated de', $translations->get('de'));
        $this->assertEquals('translated en', $translations->get('en'));
    }
}
