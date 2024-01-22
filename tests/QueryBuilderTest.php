<?php


use KCNetwork\Liquipedia\Query\QueryBuilder;

it('can be instantiated', function () {
    $queryBuilder = new class extends QueryBuilder {
    };

    expect($queryBuilder)->toBeInstanceOf(QueryBuilder::class);
});

it('can be instantiated with params', function () {
    $queryBuilder = new class(['foo' => 'bar']) extends QueryBuilder {
    };

    expect($queryBuilder->build())->toBe(['foo' => 'bar']);
});

it('can be instantiated with params and build', function () {
    $queryBuilder = new class(['foo' => 'bar']) extends QueryBuilder {
        public function build(): array
        {
            return ['bar' => 'foo'];
        }
    };

    expect($queryBuilder->build())->toBe(['bar' => 'foo']);
});


