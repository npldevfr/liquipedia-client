<?php

use Npldevfr\Liquipedia\Endpoints\Endpoints;
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Query\QueryParameters;
use Npldevfr\Liquipedia\Wikis\Wikis;

it('can build a query', function () {
    $builder = LiquipediaBuilder::query([
        'wiki' => Wikis::LEAGUE_OF_LEGENDS,
    ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can build a query with a query parameter object', function () {
    $builder = LiquipediaBuilder::query([], new QueryParameters([
        'wiki' => Wikis::LEAGUE_OF_LEGENDS,
    ]));

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can build a query with a query parameter object and params', function () {
    $builder = LiquipediaBuilder::query([
        'wiki' => Wikis::LEAGUE_OF_LEGENDS,
    ], new QueryParameters([
        'limit' => 1,
    ]));

    expect($builder->build())->toBe([
        'limit' => 1,
    ]);
});

it('can set one wiki', function () {
    $builder = LiquipediaBuilder::query()->wikis(Wikis::LEAGUE_OF_LEGENDS);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can set multiple wikis', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis([
            Wikis::LEAGUE_OF_LEGENDS,
            Wikis::OVERWATCH,
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can set multiple wikis with duplicates', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis([
            Wikis::LEAGUE_OF_LEGENDS,
            Wikis::LEAGUE_OF_LEGENDS,
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can set multiple wikis with duplicates and a string', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis([
            Wikis::LEAGUE_OF_LEGENDS,
            'overwatch',
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can add a wiki', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis(Wikis::LEAGUE_OF_LEGENDS)
        ->addWiki(Wikis::OVERWATCH);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can add a wiki with duplicates', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis(Wikis::LEAGUE_OF_LEGENDS)
        ->addWiki(Wikis::LEAGUE_OF_LEGENDS);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can add a wiki with duplicates and a string', function () {
    $builder = LiquipediaBuilder::query()
        ->wikis(Wikis::LEAGUE_OF_LEGENDS)
        ->addWiki(Wikis::LEAGUE_OF_LEGENDS)
        ->addWiki(Wikis::OVERWATCH)
        ->addWiki('overwatch');

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can set a limit', function () {
    $builder = LiquipediaBuilder::query()
        ->limit(1);

    expect($builder->build())->toBe([
        'limit' => 1,
    ]);
});

it('can set an offset', function () {
    $builder = LiquipediaBuilder::query()
        ->offset(1);

    expect($builder->build())->toBe([
        'offset' => 1,
    ]);
});

it('can set a limit and an offset', function () {
    $builder = LiquipediaBuilder::query()
        ->limit(1)
        ->offset(1);

    expect($builder->build())->toBe([
        'limit' => 1,
        'offset' => 1,
    ]);
});

it('can set an endpoint', function () {
    $builder = LiquipediaBuilder::query()
        ->endpoint(Endpoints::MATCHES);

    expect($builder->getEndpoint())->toBe(Endpoints::MATCHES);
});

it('can set an endpoint and a wiki', function () {
    $builder = LiquipediaBuilder::query()
        ->endpoint(Endpoints::MATCHES)
        ->wikis(Wikis::LEAGUE_OF_LEGENDS);

    expect($builder->build())
        ->toBe([
            'wiki' => 'leagueoflegends',
        ])
        ->and($builder->getEndpoint())
        ->toBe(Endpoints::MATCHES);

});
