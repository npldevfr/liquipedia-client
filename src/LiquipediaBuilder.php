<?php

namespace Npldevfr\Liquipedia;

use Exception;
use GuzzleHttp\Client;
use Npldevfr\Liquipedia\Endpoints\Endpoints;
use Npldevfr\Liquipedia\Query\QueryBuilder;
use Npldevfr\Liquipedia\Query\QueryParameters;

final class LiquipediaBuilder extends QueryBuilder
{
    private string $endpoint;

    public function __construct(
        ?array $params = [],
        ?QueryParameters $queryParameters = null,
        ?Client $client = null
    ) {

        parent::__construct($params, $queryParameters, $client ?? new Client([
            'base_uri' => 'https://api.liquipedia.net/api/',
        ]));
    }

    /**
     * @param  array<string>  $params
     */
    public static function query(array $params = [], ?QueryParameters $queryParameters = null): self
    {
        return new self($params, $queryParameters);
    }

    /**
     * Set the wikis you want to query. You can pass an array of wikis or a string.
     * Multi-wiki calls can be done by pipe-separating (|) wiki names.
     *
     * @param  array<string> | string  $wikis
     * @return $this
     */
    public function wikis(array|string $wikis): self
    {

        $this->queryParameters->wiki = implode(
            '|',
            array_unique(
                (array) $wikis
            )
        );
        $this->avoidWikiDuplicates();

        return $this;
    }

    /**
     * Add a wiki to the wikis you want to query.
     *
     * @return $this
     */
    public function addWiki(string $wiki): self
    {
        $this->queryParameters->wiki .= '|'.$wiki;
        $this->avoidWikiDuplicates();

        return $this;
    }

    /**
     * Set a result limit.
     *
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->queryParameters->limit = $limit;

        return $this;
    }

    /**
     * Set a result offset.
     *
     * @return $this
     */
    public function offset(int $offset): self
    {
        $this->queryParameters->offset = $offset;

        return $this;
    }

    /**
     * Set the endpoint you want to query.
     *
     * @return $this
     *
     * @throws Exception
     */
    public function endpoint(string $endpoint): self
    {
        if (! Endpoints::fromArray($endpoint)) {
            throw new Exception('[LiquipediaBuilder] Endpoint '.$endpoint.' is not valid.');
        }
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get the endpoint you want to query.
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Filter the wikis and remove the duplicates.
     */
    private function avoidWikiDuplicates(): void
    {
        $this->queryParameters->wiki = implode(
            '|',
            array_unique(
                explode(
                    '|',
                    $this->queryParameters->wiki
                )
            )
        );
    }

    //
    //    /**
    //     * @return $this
    //     */
    //    public function addWiki(string $wiki): self
    //    {
    //        $this->params['wiki'] .= '|'.$wiki;
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @return $this
    //     */
    //    public function removeWiki(string $wiki): self
    //    {
    //        $this->params['wiki'] = preg_replace(
    //            '/\|+/',
    //            '|',
    //            str_replace(
    //                $wiki,
    //                '',
    //                (string) $this->params['wiki']
    //            )
    //        );
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @return $this
    //     */
    //    public function limit(int $limit): self
    //    {
    //        $this->params['limit'] = $limit;
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @return $this
    //     */
    //    public function rawConditions(string $conditions): self
    //    {
    //        $this->params['conditions'] = trim($this->params['conditions'].' '.$conditions);
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @return $this
    //     *
    //     * @throws Exception
    //     */
    //    public function andCondition(string $key, string $operator, string $value): self
    //    {
    //        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
    //        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
    //            throw new Exception('Operator must be ::, ::!, ::< or ::>');
    //        }
    //
    //        $this->params['conditions'] = trim($this->params['conditions'].' AND '."[[{$key}{$operator}{$value}]]");
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @param  array<string>  $values
    //     * @return $this
    //     *
    //     * @throws Exception
    //     */
    //    public function andConditions(string $key, string $operator, array $values): self
    //    {
    //        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
    //        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
    //            throw new Exception('Operator must be ::, ::!, ::< or ::>');
    //        }
    //
    //        $conditions = [];
    //        foreach ($values as $value) {
    //            $conditions[] = "[[{$key}{$operator}{$value}]]";
    //        }
    //
    //        $this->params['conditions'] = trim($this->params['conditions'].' '.implode(' AND ', $conditions));
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @return $this
    //     *
    //     * @throws Exception
    //     */
    //    public function orCondition(string $key, string $operator, string $value): self
    //    {
    //        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
    //        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
    //            throw new Exception('Operator must be ::, ::!, ::< or ::>');
    //        }
    //
    //        $this->params['conditions'] = trim($this->params['conditions'].' OR '."[[{$key}{$operator}{$value}]]");
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @param  array<string>  $values
    //     * @return $this
    //     *
    //     * @throws Exception
    //     */
    //    public function orConditions(string $key, string $operator, array $values): self
    //    {
    //        // operator are : :: (equals), ::! (not equals), ::< (lower than) or ::> (greater than).
    //        if (! in_array($operator, ['::', '::!', '::<', '::>'])) {
    //            throw new Exception('Operator must be ::, ::!, ::< or ::>');
    //        }
    //
    //        $conditions = [];
    //        foreach ($values as $value) {
    //            $conditions[] = "[[{$key}{$operator}{$value}]]";
    //        }
    //
    //        $this->params['conditions'] = trim($this->params['conditions'].' OR '.implode(' OR ', $conditions));
    //        $this->params['conditions'] = trim(preg_replace('/^OR/', '', $this->params['conditions']));
    //
    //        return $this;
    //    }
    //
    //    public function select(array $fields): self
    //    {
    //        if (! isset($this->params['query'])) {
    //            $this->params['query'] = implode(',', $fields);
    //        } else {
    //            $this->params['query'] .= ','.implode(',', $fields);
    //        }
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * What you want your results grouped by (this can be helpful when using aggregate functions).
    //     * Example: pagename ASC
    //     *
    //     * @throws Exception
    //     */
    //    public function groupBy(string $field, string $direction = 'ASC'): self
    //    {
    //
    //        if (! in_array(strtoupper($direction), ['ASC', 'DESC'])) {
    //            throw new Exception('Direction must be ASC or DESC');
    //        }
    //
    //        $this->params['groupby'] = "{$field} {$direction}";
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * The order you want your result in.
    //     * Example: pagename ASC
    //     *
    //     * @throws Exception
    //     */
    //    public function orderBy(string $field, string $direction = 'ASC'): self
    //    {
    //
    //        if (! in_array(strtoupper($direction), ['ASC', 'DESC'])) {
    //            throw new Exception('Direction must be ASC or DESC');
    //        }
    //
    //        $this->params['order'] = "{$field} {$direction}";
    //
    //        return $this;
    //    }
    //
    //    public function setEndpoint(string $endpoint): self
    //    {
    //        $this->endpoint = $endpoint;
    //
    //        return $this;
    //    }
    //
    //    /**
    //     * @throws GuzzleException
    //     * @throws Exception
    //     */
    //    public function get(?string $endpoint = null): array
    //    {
    //
    //        $customEndpoint = $endpoint ?? $this->endpoint;
    //        $response = json_decode($this->client->get($customEndpoint, [
    //            'query' => $this->params,
    //        ])->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    //
    //        if (isset($response->error)) {
    //            throw new Exception($response->error);
    //        }
    //
    //        return $response->result ?? [];
    //    }
}
