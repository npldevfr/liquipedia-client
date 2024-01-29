<?php

use Npldevfr\Liquipedia\ConditionsBuilder;
use Npldevfr\Liquipedia\Meta\Operator;

it('can build a with all conditions', function ($condition) {

    $builder = ConditionsBuilder::build(
        'my_key', $condition, 'my_value'
    );

    expect($builder->toValue())
        ->toBe('([[my_key'.$condition.'my_value]])');
})->with(Operator::all());

it('can build with default constructor & and method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->and('my_key', '::', 'my_value')
            ->toValue()
    )->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]])');
});

it('can build without default constructor & andManyAnd method', function () {
    $builder = ConditionsBuilder::build()
        ->andManyAnd('my_key', '::', ['my_value', 'my_value2']);

    expect($builder->toValue())
        ->toBe('([[my_key::my_value]] AND [[my_key::my_value2]])');

});

it('can build with default constructor & andManyA d method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->andManyAnd('my_key', '::', ['my_value', 'my_value2'])
            ->toValue()
    )->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] AND [[my_key::my_value2]])');
});

it('can build with default constructor & andManyOr method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->andManyOr('my_key', '::', ['my_value', 'my_value2'])
            ->toValue()
    )->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] OR [[my_key::my_value2]])');
});

it('can build with default constructor & or method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->or('my_key', '::', 'my_value')
            ->toValue()
    )->toBe('([[build_key::!build_value]]) OR ([[my_key::my_value]])');
});

it('can build with default constructor & orManyAnd method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->orManyAnd('my_key', '::', ['my_value', 'my_value2'])
            ->toValue()
    )->toBe('([[build_key::!build_value]]) OR ([[my_key::my_value]] AND [[my_key::my_value2]])');
});

it('can build with default constructor & orManyOr method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->orManyOr('my_key', '::', ['my_value', 'my_value2'])
            ->toValue()
    )->toBe('([[build_key::!build_value]]) OR ([[my_key::my_value]] OR [[my_key::my_value2]])');
});

it('can build with default constructor & andManyAnd method', function () {

    expect(
        ConditionsBuilder::build('build_key', Operator::NOT_EQUAL, 'build_value')
            ->andManyAnd('my_key', '::', ['my_value', 'my_value2'])
            ->toValue()
    )->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] AND [[my_key::my_value2]])');
});

it('can build with default constructor & andManyAnd & orManyAnd methods', function () {

    $builder = ConditionsBuilder::build('build_key', '::!', 'build_value')
        ->andManyAnd('my_key', '::', ['my_value', 'my_value2'])
        ->orManyAnd('my_key2', '::', ['my_value', 'my_value2']);

    expect($builder->toValue())
        ->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] AND [[my_key::my_value2]]) OR ([[my_key2::my_value]] AND [[my_key2::my_value2]])');

});

it('can build with default constructor & andManyAnd & orManyOr methods', function () {

    $builder = ConditionsBuilder::build('build_key', '::!', 'build_value')
        ->andManyAnd('my_key', '::', ['my_value', 'my_value2'])
        ->orManyOr('my_key2', '::', ['my_value', 'my_value2']);

    expect($builder->toValue())
        ->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] AND [[my_key::my_value2]]) OR ([[my_key2::my_value]] OR [[my_key2::my_value2]])');

});

it('can build with default constructor & andManyOr & orManyAnd methods', function () {

    $builder = ConditionsBuilder::build('build_key', '::!', 'build_value')
        ->andManyOr('my_key', '::', ['my_value', 'my_value2'])
        ->orManyAnd('my_key2', '::', ['my_value', 'my_value2']);

    expect($builder->toValue())
        ->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] OR [[my_key::my_value2]]) OR ([[my_key2::my_value]] AND [[my_key2::my_value2]])');

});

it('can build with default constructor & andManyOr & orManyOr methods', function () {

    $builder = ConditionsBuilder::build('build_key', '::!', 'build_value')
        ->andManyOr('my_key', '::', ['my_value', 'my_value2'])
        ->orManyOr('my_key2', '::', ['my_value', 'my_value2']);

    expect($builder->toValue())
        ->toBe('([[build_key::!build_value]]) AND ([[my_key::my_value]] OR [[my_key::my_value2]]) OR ([[my_key2::my_value]] OR [[my_key2::my_value2]])');

});
