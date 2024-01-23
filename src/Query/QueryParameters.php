<?php

namespace Npldevfr\Liquipedia\Query;

use Npldevfr\Liquipedia\Interfaces\QueryParametersInterface;

final class QueryParameters implements QueryParametersInterface
{
    public string $wiki;

    public int $limit;

    public int $offset;

    public string $query;

    public string $conditions;

    public string $order;

    public string $template;

    public int $pagination;

    public string $groupby;

    public string $date;

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function toArray(): array
    {

        return array_filter((array) $this);
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}
