<?php

use PokeDB\PokeApiClient\Api\Endpoint;
use PokeDB\PokeApiClient\Api\Resource;

it('can be instantiated', function () {
    $endpoint = new Endpoint(Resource::BERRY);
    expect($endpoint)->toBeInstanceOf(Endpoint::class)->and($endpoint->resource)->toBe(Resource::BERRY);
});
