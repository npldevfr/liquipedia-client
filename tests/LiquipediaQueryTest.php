<?php

use Npldevfr\Liquipedia\ConditionsBuilder;
use Npldevfr\Liquipedia\Liquipedia;
use Npldevfr\Liquipedia\Meta\Endpoint;

it('can query liquipedia api', function () {

    $liquipedia = new Liquipedia('myapikey');
    dd($liquipedia
        ->query()
        ->endpoint(Endpoint::MATCHES)
        ->rawConditions(
            ConditionsBuilder::build(
                'opponent',
                '::',
                'Karmine Corp'
            )->toValue()
        )
        ->limit(10)
        ->get());

})->only();
