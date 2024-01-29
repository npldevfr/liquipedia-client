<?php

namespace Npldevfr\Liquipedia\Interfaces;

use Exception;

interface ConditionsBuilderInterface
{
    /**
     * @throws Exception
     */
    public function and(string $key, string $operator, string $value): self;

    /**
     * @param  array<string>  $values
     *
     * @throws Exception
     */
    public function andManyAnd(string $key, string $operator, array $values): self;

    /**
     * @param  array<string>  $values
     *
     * @throws Exception
     */
    public function andManyOr(string $key, string $operator, array $values): self;

    /**
     * @throws Exception
     */
    public function or(string $key, string $operator, string $value): self;

    /**
     * @param  array<string>  $values
     *
     * @throws Exception
     */
    public function orManyAnd(string $key, string $operator, array $values): self;

    /**
     * @param  array<string>  $values
     *
     * @throws Exception
     */
    public function orManyOr(string $key, string $operator, array $values): self;

    public function toValue(): string;

    /**
     * @throws Exception
     */
    public static function build(?string $key = null,
        ?string $operator = null,
        ?string $value = null): self;
}
