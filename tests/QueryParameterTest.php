<?php

use Npldevfr\Liquipedia\Query\QueryParameters;

it('can be instantiated', function () {
    $queryParameter = new QueryParameters();

    expect($queryParameter)->toBeInstanceOf(QueryParameters::class);
});

it('can get by magic method', function () {
    $queryParameter = new QueryParameters([
        'limit' => 10,
    ]);

    expect($queryParameter->limit)->toBe(10);
});

it('can set by magic method', function () {
    $queryParameter = new QueryParameters();

    $queryParameter->wiki = 'foo';
    expect($queryParameter->wiki)->toBe('foo');
});

it('can be converted to array', function () {
    $queryParameter = new QueryParameters([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    expect($queryParameter->toArray())->toBe([
        'wiki' => 'foo',
        'limit' => 10,
    ])->and($queryParameter->wiki)->toBe('foo')
        ->and($queryParameter->limit)->toBe(10);

});

it('can be converted to string', function () {
    $queryParameter = new QueryParameters([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    expect((string) $queryParameter)->toBe('{"wiki":"foo","limit":10}');
});

it('can be set', function () {
    $queryParameter = new QueryParameters([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    $queryParameter->wiki = 'bar';

    expect($queryParameter->toArray())->toBe([
        'wiki' => 'bar',
        'limit' => 10,
    ]);
});
