<?php

namespace Npldevfr\Liquipedia\Query;

use Npldevfr\Liquipedia\Interfaces\QueryParametersInterface;
use stdClass;

final readonly class QueryParameters implements QueryParametersInterface
{
    private stdClass $params;

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
