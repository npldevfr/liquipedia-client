<?php

namespace Npldevfr\Liquipedia;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Npldevfr\Liquipedia\Interfaces\LiquipediaBuilderInterface;
use Npldevfr\Liquipedia\Meta\Endpoint;
use Npldevfr\Liquipedia\Meta\SortOrder;
use Npldevfr\Liquipedia\Query\QueryBuilder;
use Npldevfr\Liquipedia\Query\QueryParameters;

final class LiquipediaBuilder extends QueryBuilder implements LiquipediaBuilderInterface
{
    private string $endpoint;

    private bool $hasRawConditions = false;

    public function __construct(
        ?array $params = [],
        ?QueryParameters $queryParameters = null,
        ?Client $client = new Client()
    ) {
        parent::__construct($params, $queryParameters, $client);
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
     * @param  string | array<string>  $wikis
     * @return $this
     */
    public function addWikis(string|array $wikis): self
    {
        $this->queryParameters->wiki .= '|'.implode(
            '|',
            array_unique(
                (array) $wikis
            )
        );
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
        if (! Endpoint::fromValue($endpoint)) {
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
    public function orderBy(string $orderBy, string $direction = 'ASC'): self
    {

        $direction = strtoupper($direction);

        if (! SortOrder::fromValue($direction)) {
            throw new Exception('[LiquipediaBuilder] Direction '.$direction.' is not valid.');
        }

        $this->queryParameters->order = "{$orderBy} ".$direction;

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
     * Set the date you want to query.
     *
     * @return $this
     *
     * @throws Exception
     */
    public function date(string $date): self
    {

        if (! preg_match('/\d{4}-\d{2}-\d{2}/', $date) || preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $date)) {
            throw new Exception('[LiquipediaBuilder] Date '.$date.' is not valid.');
        }

        $this->queryParameters->date = $date;

        return $this;
    }

    /**
     * Set the template you want to query.
     *
     * @return $this
     */
    public function template(string $template): self
    {
        $this->queryParameters->template = $template;

        return $this;
    }

    /**
     * Set the conditions you want to query without any formatting.
     * It will
     *
     * @return $this
     *
     * @throws Exception
     */
    public function rawConditions(string $conditions): self
    {
        if ($this->hasRawConditions) {
            throw new Exception('[LiquipediaBuilder] You can only set one raw condition.');
        }

        $this->hasRawConditions = true;
        $this->queryParameters->conditions = $conditions;

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

    /**
     * @return array<string>
     *
     * @throws JsonException | Exception | GuzzleException
     */
    public function get(?string $endpoint = null): array
    {

        $customEndpoint = $endpoint ?? $this->endpoint;
        $response = json_decode($this->client->get($customEndpoint, [
            'query' => $this->queryParameters->toArray(),
        ])->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        /**
         * @var object $response
         */
        if (isset($response->error)) {
            throw new Exception($response->error);
        }

        return $response->result ?? [];
    }
}
