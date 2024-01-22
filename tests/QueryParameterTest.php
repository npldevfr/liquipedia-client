<?php

use KCNetwork\Liquipedia\Query\QueryParameter;

it('it can be instantiated', function () {
    $queryParameter = new QueryParameter();

    expect($queryParameter)->toBeInstanceOf(QueryParameter::class);
});

