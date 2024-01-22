<?php

namespace KCNetwork\Liquipedia;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use KCNetwork\Liquipedia\Query\QueryBuilder;

class Query extends QueryBuilder
{
    protected Client $client;

    protected string $endpoint;

    /**
     * @param array<string, mixed> $params
     * @param Client|null $client
     */
    public function __construct(array $params = [], ?Client $client = null)
    {
        parent::__construct(array_merge([
            'wiki' => '',
            'limit' => 100,
            'conditions' => '',
        ], $params));

        $this->client = $client ?? new Client([
            'base_uri' => 'https://api.liquipedia.net/api/',
        ]);
    }

    /**
     * @param array<string> $wikis
     */
    public function wikis(array $wikis): self
    {

        $wikis = implode('|', $wikis);
        $wikis = preg_replace('/\|+/', '|', $wikis);

        $this->params['wiki'] = $wikis;

        return $this;
    }

    public function addWiki(string $wiki): self
    {
        $this->params['wiki'] .= '|'.$wiki;

        return $this;
    }

    public function removeWiki(string $wiki): self
    {
        $this->params['wiki'] = preg_replace(
            '/\|+/',
            '|',
            str_replace(
                $wiki,
                '',
                $this->params['wiki']
            )
        );

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    public function rawConditions(string $conditions): self
    {
        $this->params['conditions'] = trim($this->params['conditions'].' '.$conditions);

        return $this;
    }

    /**
     * @throws Exception
     */
    public function andCondition(string $key, string $operator, string $value): self
    {
        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
            throw new Exception('Operator must be ::, ::!, ::< or ::>');
        }

        $this->params['conditions'] = trim($this->params['conditions'].' AND '."[[{$key}{$operator}{$value}]]");

        return $this;
    }

    /**
     * @param array<string> $values
     */
    public function andConditions(string $key, string $operator, array $values): self
    {
        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
            throw new Exception('Operator must be ::, ::!, ::< or ::>');
        }

        $conditions = [];
        foreach ($values as $value) {
            $conditions[] = "[[{$key}{$operator}{$value}]]";
        }

        $this->params['conditions'] = trim($this->params['conditions'].' '.implode(' AND ', $conditions));

        return $this;
    }

    public function orCondition(string $key, string $operator, string $value): self
    {
        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
            throw new Exception('Operator must be ::, ::!, ::< or ::>');
        }

        $this->params['conditions'] = trim($this->params['conditions'].' OR '."[[{$key}{$operator}{$value}]]");

        return $this;
    }

    public function orConditions(string $key, string $operator, array $values): self
    {
        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
            throw new Exception('Operator must be ::, ::!, ::< or ::>');
        }

        $conditions = [];
        foreach ($values as $value) {
            $conditions[] = "[[{$key}{$operator}{$value}]]";
        }

        $this->params['conditions'] = trim($this->params['conditions'].' OR '.implode(' OR ', $conditions));
        $this->params['conditions'] = trim(preg_replace('/^OR/', '', $this->params['conditions']));

        return $this;
    }

    public function select(array $fields): self
    {
        if (! isset($this->params['query'])) {
            $this->params['query'] = implode(',', $fields);
        } else {
            $this->params['query'] .= ','.implode(',', $fields);
        }

        return $this;
    }

    /**
     * What you want your results grouped by (this can be helpful when using aggregate functions).
     * Example: pagename ASC
     *
     * @throws Exception
     */
    public function groupBy(string $field, string $direction = 'ASC'): self
    {

        if (! in_array(strtoupper($direction), ['ASC', 'DESC'])) {
            throw new Exception('Direction must be ASC or DESC');
        }

        $this->params['groupby'] = "{$field} {$direction}";

        return $this;
    }

    /**
     * The order you want your result in.
     * Example: pagename ASC
     *
     * @throws Exception
     */
    public function orderBy(string $field, string $direction = 'ASC'): self
    {

        if (! in_array(strtoupper($direction), ['ASC', 'DESC'])) {
            throw new Exception('Direction must be ASC or DESC');
        }

        $this->params['order'] = "{$field} {$direction}";

        return $this;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(?string $endpoint = null): array
    {

        $customEndpoint = $endpoint ?? $this->endpoint;

        $response = json_decode($this->client->get($customEndpoint, [
            'query' => $this->params,
        ])->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        if (isset($response->error)) {
            throw new Exception($response->error);
        }

        return $response->result ?? [];
    }
}
