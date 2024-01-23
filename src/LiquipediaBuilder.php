<?php

namespace Npldevfr\Liquipedia;

use Exception;
use GuzzleHttp\Client;
use Npldevfr\Liquipedia\Meta\Endpoints;
use Npldevfr\Liquipedia\Meta\SortOrder;
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
     *
     * @throws Exception
     */
    public function limit(int $limit): self
    {
        if ($limit > 9999) {
            throw new Exception('[LiquipediaBuilder] Limit cannot be greater than 9999.');
        }

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
        if (! Endpoints::fromValue($endpoint)) {
            throw new Exception('[LiquipediaBuilder] Endpoint '.$endpoint.' is not valid.');
        }
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * The datapoints you want to query.
     *
     * @param  array<string> |string  $fields
     * @return $this
     */
    public function select(array|string $fields): self
    {
        $fields = is_string($fields) ? explode(',', str_replace(' ', '', $fields)) : $fields;

        $existingFields = $this->queryParameters->query ?? '';
        $newFields = array_unique(array_filter($fields));

        $allFields = array_merge(explode(',', $existingFields), $newFields);
        $this->queryParameters->query = implode(',', array_unique(array_filter($allFields)));

        return $this;
    }

    /**
     * Set the pagination of the results.
     *
     * @return $this
     */
    public function pagination(int|string $pagination): self
    {
        $this->queryParameters->pagination = (int) $pagination;

        return $this;
    }

    /**
     * Order by a field.
     *
     * @throws Exception
     */
    public function orderBy(string $field, string $direction = 'ASC'): self
    {

        $direction = strtoupper($direction);

        if (! SortOrder::fromValue($direction)) {
            throw new Exception('[LiquipediaBuilder] Direction '.$direction.' is not valid.');
        }

        $this->queryParameters->order = "{$field} ".$direction;

        return $this;
    }

    /**
     * Group by a field.
     *
     * @throws Exception
     */
    public function groupBy(string $field, string $direction = 'ASC'): self
    {

        $direction = strtoupper($direction);

        if (! SortOrder::fromValue($direction)) {
            throw new Exception('[LiquipediaBuilder] Direction '.$direction.' is not valid.');
        }

        $this->queryParameters->groupby = "{$field} ".$direction;

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
