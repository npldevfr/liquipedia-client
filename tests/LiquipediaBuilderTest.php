<?php

use Npldevfr\Liquipedia\ConditionsBuilder;
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta\Endpoint;
use Npldevfr\Liquipedia\Meta\SortOrder;
use Npldevfr\Liquipedia\Meta\Wiki;

it('can set one wiki', function () {
    $builder = (new LiquipediaBuilder())->wikis(Wiki::LEAGUE_OF_LEGENDS);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can set multiple wikis', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis([
            Wiki::LEAGUE_OF_LEGENDS,
            Wiki::OVERWATCH,
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can set multiple wikis with duplicates', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis([
            Wiki::LEAGUE_OF_LEGENDS,
            Wiki::LEAGUE_OF_LEGENDS,
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can set multiple wikis with duplicates and a string', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis([
            Wiki::LEAGUE_OF_LEGENDS,
            'overwatch',
        ]);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can add a wiki', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis(Wiki::LEAGUE_OF_LEGENDS)
        ->addWiki(Wiki::OVERWATCH);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can add a wiki with duplicates', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis(Wiki::LEAGUE_OF_LEGENDS)
        ->addWiki(Wiki::LEAGUE_OF_LEGENDS);

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends',
    ]);
});

it('can add a wiki with duplicates and a string', function () {
    $builder = (new LiquipediaBuilder())
        ->wikis(Wiki::LEAGUE_OF_LEGENDS)
        ->addWiki(Wiki::LEAGUE_OF_LEGENDS)
        ->addWiki(Wiki::OVERWATCH)
        ->addWiki('overwatch');

    expect($builder->build())->toBe([
        'wiki' => 'leagueoflegends|overwatch',
    ]);
});

it('can set a limit', function () {
    $builder = (new LiquipediaBuilder())
        ->limit(1);

    expect($builder->build())->toBe([
        'limit' => 1,
    ]);
});

it('can set an offset', function () {
    $builder = (new LiquipediaBuilder())
        ->offset(1);

    expect($builder->build())->toBe([
        'offset' => 1,
    ]);
});

it('can set a limit and an offset', function () {
    $builder = (new LiquipediaBuilder())
        ->limit(1)
        ->offset(1);

    expect($builder->build())->toBe([
        'limit' => 1,
        'offset' => 1,
    ]);
});

it('can set an endpoint', function () {
    $builder = (new LiquipediaBuilder())
        ->endpoint(Endpoint::MATCHES);

    expect($builder->getEndpoint())->toBe(Endpoint::MATCHES);
});

it('can set an endpoint and a wiki', function () {

    $builder = (new LiquipediaBuilder())
        ->endpoint(Endpoint::MATCHES)
        ->wikis(Wiki::LEAGUE_OF_LEGENDS);

    expect($builder->build())
        ->toBe([
            'wiki' => 'leagueoflegends',
        ])
        ->and($builder->getEndpoint())
        ->toBe(Endpoint::MATCHES);

});

it('can select only some fields', function () {
    $builder = (new LiquipediaBuilder())
        ->select([
            'field1',
            'field2',
        ]);

    expect($builder->build())->toBe([
        'query' => 'field1,field2',
    ]);
});

it('can select only some fields with a string', function () {
    $builder = (new LiquipediaBuilder())
        ->select('field1, field2,field3');

    expect($builder->build())->toBe([
        'query' => 'field1,field2,field3',
    ]);
});

it('can select only some fields with a string and an array', function () {
    $builder = (new LiquipediaBuilder())
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
    $builder = (new LiquipediaBuilder())
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
    $builder = (new LiquipediaBuilder())
        ->pagination(1);

    expect($builder->build())->toBe([
        'pagination' => 1,
    ]);

});

it('can use pagination with a string', function () {
    $builder = (new LiquipediaBuilder())
        ->pagination('1');

    expect($builder->build())->toBe([
        'pagination' => 1,
    ]);

});

it('can use pagination with a string and an int', function () {
    $builder = (new LiquipediaBuilder())
        ->pagination('1')
        ->pagination(2);

    expect($builder->build())->toBe([
        'pagination' => 2,
    ]);

});

it('can order by a field', function ($order) {
    $builder = (new LiquipediaBuilder())
        ->orderBy('field1', $order);

    expect($builder->build())->toBe([
        'order' => 'field1 '.$order,
    ]);
})->with(SortOrder::all());

it('cannot order by a field with an invalid order', function () {
    expect(
        fn () => (new LiquipediaBuilder())
            ->orderBy('field1', 'invalid')
    )->toThrow(Exception::class);
});

it('can order by a field with a string', function ($order) {
    $builder = (new LiquipediaBuilder())
        ->orderBy('field1', $order)
        ->orderBy('field2', 'asc');

    expect($builder->build())->toBe([
        'order' => 'field2 ASC',
    ]);
})->with(SortOrder::all());

it('can group by a field', function () {
    $builder = (new LiquipediaBuilder())
        ->groupBy('field1');

    expect($builder->build())->toBe([
        'groupby' => 'field1 ASC',
    ]);
});

it('can group by a field with a string', function () {
    $builder = (new LiquipediaBuilder())
        ->groupBy('field1', 'DESC');

    expect($builder->build())->toBe([
        'groupby' => 'field1 DESC',
    ]);
});

it('can group by a field with a string and an array', function () {
    $builder = (new LiquipediaBuilder())
        ->groupBy('field1', 'DESC')
        ->groupBy('field2', 'ASC');

    expect($builder->build())->toBe([
        'groupby' => 'field2 ASC',
    ]);
});

it('can group by a field with a string and an array with duplicates', function () {
    $builder = (new LiquipediaBuilder())
        ->groupBy('field1', 'DESC')
        ->groupBy('field2', 'ASC')
        ->groupBy('field2', 'ASC');

    expect($builder->build())->toBe([
        'groupby' => 'field2 ASC',
    ]);
});

it('can set template', function () {
    $builder = (new LiquipediaBuilder())
        ->template('template1');

    expect($builder->build())->toBe([
        'template' => 'template1',
    ]);
});

it('can add date', function () {
    $builder = (new LiquipediaBuilder())
        ->date('2020-01-01');

    expect($builder->build())->toBe([
        'date' => '2020-01-01',
    ]);
});

it('cannot add date with wrong format', function () {
    expect(
        fn () => (new LiquipediaBuilder())
            ->date('2020-01-01 00:00:00')
    )->toThrow(Exception::class);
});

it('can add date with a string', function () {
    $builder = (new LiquipediaBuilder())
        ->date('2020-01-01')
        ->date('2020-01-02');

    expect($builder->build())->toBe([
        'date' => '2020-01-02',
    ]);
});

it('can set raw conditions', function () {
    $builder = (new LiquipediaBuilder())
        ->rawConditions('[[pagename::value]]');

    expect($builder->build())->toBe([
        'conditions' => '[[pagename::value]]',
    ]);
});

it('cannot set 2 raw conditions', function () {
    expect(
        fn () => (new LiquipediaBuilder())
            ->rawConditions('[[pagename::value]]')
            ->rawConditions('[[pagename::value]]')
    )->toThrow(Exception::class);
});

it('can build a complex query', function ($wiki) {
    $builder = (new LiquipediaBuilder())
        ->wikis($wiki)
        ->endpoint(Endpoint::MATCHES)
        ->limit(1)
        ->offset(1)
        ->select([
            'field1',
            'field2',
        ])
        ->pagination(1)
        ->orderBy('field1', SortOrder::ASC)
        ->groupBy('field1', SortOrder::DESC)
        ->date('2020-01-01')
        ->rawConditions(
            ConditionsBuilder::build('pagename', '::', 'value')
                ->toValue()
        );

    expect($builder->build())->toBe([
        'wiki' => $wiki,
        'limit' => 1,
        'offset' => 1,
        'query' => 'field1,field2',
        'conditions' => '([[pagename::value]])',
        'order' => 'field1 ASC',
        'pagination' => 1,
        'groupby' => 'field1 DESC',
        'date' => '2020-01-01',
    ]);
})->with([
    Wiki::LEAGUE_OF_LEGENDS,
    Wiki::OVERWATCH,
]);
