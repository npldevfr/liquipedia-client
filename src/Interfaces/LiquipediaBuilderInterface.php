<?php

namespace Npldevfr\Liquipedia\Interfaces;

interface LiquipediaBuilderInterface
{
    /**
     * Set wikis you want to query.
     *
     * @param  array<string> | string  $wikis
     */
    public function wikis(array|string $wikis): self;

    /**
     * Set the endpoint you want to query.
     */
    public function endpoint(string $endpoint): self;

    /**
     * Set the conditions you want to query.
     */
    public function rawConditions(string $conditions): self;

    /**
     * Limit the number of results.
     */
    public function limit(int $limit): self;

    /**
     * @return array<string, mixed>
     */
    public function get(): array;

    /**
     * Add a wiki to the wikis you want to query.
     */
    public function addWikis(string $wikis): self;

    /**
     * Set a result offset.
     */
    public function offset(int $offset): self;

    /**
     * Order the results.
     */
    public function orderBy(string $orderBy): self;
}
