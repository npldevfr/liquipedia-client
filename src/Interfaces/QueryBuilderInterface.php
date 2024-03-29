<?php

namespace Npldevfr\Liquipedia\Interfaces;

use GuzzleHttp\Client;
use Npldevfr\Liquipedia\Query\QueryParameters;

interface QueryBuilderInterface
{
    /**
     * @param  ?array<string, mixed>  $params
     */
    public function __construct(
        ?array $params,
        ?QueryParameters $queryParameters = null,
        ?Client $client = null
    );

    /**
     * Build the query parameters array
     *
     * @return array<string, mixed>
     */
    public function build(): array;
}
