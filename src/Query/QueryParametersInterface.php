<?php

namespace Npldevfr\Liquipedia\Query;

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

    /**
     * Returns the value of the parameter
     */
    public function __get(string $name): mixed;

    /**
     * Sets the value of the parameter
     */
    public function __set(string $name, mixed $value): void;

    /**
     * Checks if the parameter is set
     */
    public function __isset(string $name): bool;

    /**
     * Unsets the parameter
     */
    public function __unset(string $name): void;
}
