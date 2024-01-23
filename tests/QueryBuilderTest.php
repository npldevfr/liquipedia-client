<?php

use Npldevfr\Liquipedia\Query\QueryBuilder;
use Npldevfr\Liquipedia\Query\QueryParameters;


it('can be instantiated with params', function () {
    $queryBuilder = new class(['wiki' => 'leagueoflegends']) extends QueryBuilder {
    };

    expect($queryBuilder->build())->toBe(['wiki' => 'leagueoflegends']);
});

it('can be instantiated with query parameters', function () {

    $queryParameters = new QueryParameters([
        'wiki' => 'leagueoflegends'
    ]);

    $queryBuilder = new class([], $queryParameters) extends QueryBuilder {
    };

expect($queryBuilder->build())->toBe(['wiki' => 'leagueoflegends']);

});


it('can be instantiated with params and query parameters', function () {

    $queryParameters = new QueryParameters([
        'wiki' => 'leagueoflegends'
    ]);

    $queryBuilder = new class(['wiki' => 'dota2'], $queryParameters) extends QueryBuilder {
    };

    expect($queryBuilder->build())->toBe(['wiki' => 'leagueoflegends']);

});


