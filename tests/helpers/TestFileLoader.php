<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Tests\helpers;

trait TestFileLoader
{
    private function loadTestFile(string $file): string
    {
        $path = __DIR__ . '/../data/' . $file;

        if (file_exists($path)) {
            return file_get_contents($path);
        }

        return '';
    }

    private function loadTestJsonFile(string $file): array
    {
        return json_decode($this->loadTestFile($file), true);
    }
}
