<?php

namespace Npldevfr\Liquipedia\Query;

use GuzzleHttp\Client;
use Npldevfr\Liquipedia\Interfaces\QueryBuilderInterface;

abstract class QueryBuilder implements QueryBuilderInterface
{
    protected QueryParameters $queryParameters;

    protected Client $client;

    public function __construct(
        ?array $params = [],
        ?QueryParameters $queryParameters = null,
        ?Client $client = null
    ) {

        // If params are passed, we use them to build the query parameters
        if (isset($params) && $params !== []) {
            $this->queryParameters = new QueryParameters($params);
        }

        // If no params are passed, we use the query parameters passed
        else {
            $this->queryParameters = new QueryParameters();
        }

        // We prioritize the query parameters passed over the params
        if ($queryParameters instanceof QueryParameters) {
            $this->queryParameters = $queryParameters;
        }

        $this->client = $client ?? new Client();
    }

    public function build(): array
    {
        return $this->queryParameters->toArray();
    }
}
