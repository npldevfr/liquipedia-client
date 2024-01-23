<?php

use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta\Endpoints;
use Npldevfr\Liquipedia\Meta\SortOrder;
use Npldevfr\Liquipedia\Meta\Wikis;
use Npldevfr\Liquipedia\Query\QueryParameters;

it('can build with wiki', function () {
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

it('can select only some fields', function () {
    $builder = LiquipediaBuilder::query()
        ->select([
            'field1',
            'field2',
        ]);

    expect($builder->build())->toBe([
        'query' => 'field1,field2',
    ]);
});

it('can select only some fields with a string', function () {
    $builder = LiquipediaBuilder::query()
        ->select('field1, field2,field3');

    expect($builder->build())->toBe([
        'query' => 'field1,field2,field3',
    ]);
});

it('can select only some fields with a string and an array', function () {
    $builder = LiquipediaBuilder::query()
        ->select([
            'field1',
            'field2',
        ])
        ->select('field3, field4');

    expect($builder->build())->toBe([
        'query' => 'field1,field2,field3,field4',
    ]);
});

it('can select only some fields with a string and an array with duplicates', function () {
    $builder = LiquipediaBuilder::query()
        ->select([
            'field1',
            'field2',
        ])
        ->select('field3, field4,,')
        ->select('field3, field4');

    expect($builder->build())->toBe([
        'query' => 'field1,field2,field3,field4',
    ]);
});

it('can use pagination', function () {
    $builder = LiquipediaBuilder::query()
        ->pagination(1);

    expect($builder->build())->toBe([
        'pagination' => 1,
    ]);

});

it('can use pagination with a string', function () {
    $builder = LiquipediaBuilder::query()
        ->pagination('1');

    expect($builder->build())->toBe([
        'pagination' => 1,
    ]);

});

it('can use pagination with a string and an int', function () {
    $builder = LiquipediaBuilder::query()
        ->pagination('1')
        ->pagination(2);

    expect($builder->build())->toBe([
        'pagination' => 2,
    ]);

});

it('can order by a field', function ($order) {
    $builder = LiquipediaBuilder::query()
        ->orderBy('field1', $order);

    expect($builder->build())->toBe([
        'order' => 'field1 '.$order,
    ]);
})->with(SortOrder::all());

it('cannot order by a field with an invalid order', function () {
    expect(
        fn () => LiquipediaBuilder::query()
            ->orderBy('field1', 'invalid')
    )->toThrow(Exception::class);
});

it('can order by a field with a string', function ($order) {
    $builder = LiquipediaBuilder::query()
        ->orderBy('field1', $order)
        ->orderBy('field2', 'asc');

    expect($builder->build())->toBe([
        'order' => 'field2 ASC',
    ]);
})->with(SortOrder::all());

it('can group by a field', function () {
    $builder = LiquipediaBuilder::query()
        ->groupBy('field1');

    expect($builder->build())->toBe([
        'groupby' => 'field1 ASC',
    ]);
});

it('can group by a field with a string', function () {
    $builder = LiquipediaBuilder::query()
        ->groupBy('field1', 'DESC');

    expect($builder->build())->toBe([
        'groupby' => 'field1 DESC',
    ]);
});

it('can group by a field with a string and an array', function () {
    $builder = LiquipediaBuilder::query()
        ->groupBy('field1', 'DESC')
        ->groupBy('field2', 'ASC');

    expect($builder->build())->toBe([
        'groupby' => 'field2 ASC',
    ]);
});

it('can group by a field with a string and an array with duplicates', function () {
    $builder = LiquipediaBuilder::query()
        ->groupBy('field1', 'DESC')
        ->groupBy('field2', 'ASC')
        ->groupBy('field2', 'ASC');

    expect($builder->build())->toBe([
        'groupby' => 'field2 ASC',
    ]);
});
