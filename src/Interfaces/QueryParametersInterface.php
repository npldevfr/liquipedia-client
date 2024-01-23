<?php

namespace Npldevfr\Liquipedia\Interfaces;

use JsonException;

interface QueryParametersInterface
{
    /**
     * QueryParametersInterface constructor.
     *
     * @param  array<string, mixed>  $params
     */
    public function __construct(array $params = []);

    /**
     * Returns the parameters as an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * Returns the parameters as a json string
     *
     * @throws JsonException
     */
    public function __toString(): string;
}
