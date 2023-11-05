<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities\Utility;

interface Translateable
{
    public function getLocale(): string;
}
