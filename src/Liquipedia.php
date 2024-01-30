<?php

namespace Npldevfr\Liquipedia;

use GuzzleHttp\Client;

final class Liquipedia
{
    private readonly string $apiKey;

    private readonly LiquipediaBuilder $builder;

    public function __construct(
        string $apiKey,
        ?LiquipediaBuilder $builder = null
    ) {

        if ($apiKey === '') {
            throw new \InvalidArgumentException('[Liquipedia] Api key is required');
        }

        $this->apiKey = $apiKey;
        $this->builder = $builder ?? new LiquipediaBuilder(
            params: [],
            client: new Client([
                'base_uri' => 'https://api.liquipedia.net/api/v3/',
                'headers' => [
                    'Authorization' => "Apikey {$this->apiKey}",
                ],
            ]
            ));

    }

    public function query(): LiquipediaBuilder
    {
        return (new self($this->apiKey))->builder;
    }
}
