<?php

namespace KCNetwork\Liquipedia\Query;

interface QueryBuilderInterface
{

    /**
     * @param array<string, mixed> $params
     */
    public function __construct(array $params = []);

    /**
     * @return array<string, mixed>
     */
    public function build(): array;
}
