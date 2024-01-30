<?php

namespace Npldevfr\Liquipedia\Interfaces;

interface LiquipediaBuilderInterface
{
    public function wiki(array|string $wikis): self;

    public function endpoint(string $endpoint): self;

    public function rawConditions(string $conditions): self;

    public function limit(int $limit): self;

    public function get(): array;

    public function addWiki(string $wikis): self;

    public function offset(int $offset): self;

    public function orderBy(string $orderBy): self;


}
