<?php

namespace KCNetwork\Liquipedia\Query;

abstract class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function build(): array
    {
        return $this->params;
    }
}
