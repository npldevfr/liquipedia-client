<?php

namespace Npldevfr\Liquipedia\Query;

abstract class QueryBuilder implements QueryBuilderInterface
{
    public function __construct(
        /**
         * @var array<string, mixed>
         */
        protected array $params = []
    ) {
    }

    public function build(): array
    {
        return $this->params;
    }
}
