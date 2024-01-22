<?php

use Npldevfr\Liquipedia\Query\QueryParameter;

it('it can be instantiated', function () {
    $queryParameter = new QueryParameter();

    expect($queryParameter)->toBeInstanceOf(QueryParameter::class);
});

it('it can get by magic method', function () {
    $queryParameter = new QueryParameter([
        'limit' => 10,
    ]);

    expect($queryParameter->limit)->toBe(10);
});

it('it can set by magic method', function () {
    $queryParameter = new QueryParameter();

    $queryParameter->wiki = 'foo';
    expect($queryParameter->wiki)->toBe('foo');
});

it('it can be converted to array', function () {
    $queryParameter = new QueryParameter([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    expect($queryParameter->toArray())->toBe([
        'wiki' => 'foo',
        'limit' => 10,
    ])->and($queryParameter->wiki)->toBe('foo')
        ->and($queryParameter->limit)->toBe(10);

});

it('it can be converted to string', function () {
    $queryParameter = new QueryParameter([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    expect((string) $queryParameter)->toBe('{"wiki":"foo","limit":10}');
});

it('it can be set', function () {
    $queryParameter = new QueryParameter([
        'wiki' => 'foo',
        'limit' => 10,
    ]);

    $queryParameter->wiki = 'bar';

    expect($queryParameter->toArray())->toBe([
        'wiki' => 'bar',
        'limit' => 10,
    ]);
});
