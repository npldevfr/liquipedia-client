<?php

namespace Npldevfr\Liquipedia\Query;

use stdClass;

final class QueryParameter implements QueryParametersInterface
{
    private readonly stdClass $params;

    public function __construct(array $params = [])
    {

        $this->params = new stdClass();

        foreach ($params as $key => $value) {
            $this->params->{$key} = $value;
        }
    }

    public function toArray(): array
    {
        return (array) $this->params;
    }

    public function __toString(): string
    {
        return json_encode($this->params, JSON_THROW_ON_ERROR);
    }

    public function __set(string $name, mixed $value): void
    {
        $this->params->{$name} = $value;
    }

    public function __get(string $name): mixed
    {
        return $this->params->{$name};
    }
}
