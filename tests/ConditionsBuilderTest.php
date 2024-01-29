<?php

use Npldevfr\Liquipedia\ConditionsBuilder;

it('can build a with all conditions', function ($condition) {

    $builder = ConditionsBuilder::build(
        'my_key', $condition, 'my_value'
    );

    expect($builder->toValue())
        ->toBe('([[my_key'.$condition.'my_value]])');
})->with(\Npldevfr\Liquipedia\Meta\Conditions::all());

it('', function () {

    expect(
        ConditionsBuilder::build('build_key', '::!', 'build_value')
            ->and('my_key', '::', 'my_value')
            ->toValue()
    )->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]])');
});
