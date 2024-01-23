<?php

namespace Npldevfr\Liquipedia\Query;

use GuzzleHttp\Client;
use Npldevfr\Liquipedia\Interfaces\QueryBuilderInterface;

abstract class QueryBuilder implements QueryBuilderInterface
{

    public QueryParameters $queryParameters;
    protected Client $client;

    public function __construct(
        array            $params,
        ?QueryParameters $queryParameters = null,
        ?Client          $client = null
    ) {

        // If params are passed, we use them to build the query parameters
        if (count($params) > 0 && !$queryParameters)
            $this->queryParameters = new QueryParameters($params);

        // We prioritize the query parameters passed over the params
        elseif ($queryParameters)
            $this->queryParameters = $queryParameters;

        // If no params are passed, we use the query parameters passed
        else
            $this->queryParameters = new QueryParameters();

        $this->client = $client ?? new Client();
    }

    public function build(): array
    {
        return $this->queryParameters->toArray();
    }
}
