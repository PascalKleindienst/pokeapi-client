<?php

use PokeDB\PokeApiClient\Api\HttpClient;
use PokeDB\PokeApiClient\Exceptions\NetworkException;

it('throws a network exception if the request fails', function () {
    (new HttpClient())->request('http://example.com/404');
})->throws(NetworkException::class)->group('slow');

it('throws a network exception if curl fails', function () {
    (new HttpClient())->request('http://404.php.net');
})->throws(NetworkException::class)->group('slow');

it('sends a get request', function () {
    $data = (new HttpClient())->request('https://jsonplaceholder.typicode.com/todos/1');
    expect($data)->toEqual(['userId' => '1', 'id' => '1', 'title' => 'delectus aut autem', 'completed' => false]);
})->group('slow');
