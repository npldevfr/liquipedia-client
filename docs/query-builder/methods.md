# LiquipediaBuilderInterface Interface

The `LiquipediaBuilderInterface` is an interface that defines methods for building queries to interact with Liquipedia data.

# Methods

## 1. `wikis($wikis): self`

Set the wikis you want to query.

- **Parameters:**
    - `$wikis`: An array of strings or a single string representing the wikis to query.

## 2. `endpoint($endpoint): self`

Set the endpoint you want to query.

- **Parameters:**
    - `$endpoint`: A string representing the endpoint to query.

## 3. `rawConditions($conditions): self`

Set the conditions you want to query.

- **Parameters:**
    - `$conditions`: A string representing the raw conditions for the query.

## 4. `limit($limit): self`

Limit the number of results.

- **Parameters:**
    - `$limit`: An integer representing the maximum number of results to retrieve.

## 5. `get(): array`

Retrieve the query results.

- **Returns:**
    - An array containing the query results.

## 6. `addWiki($wikis): self`

Add a wiki to the wikis you want to query.

- **Parameters:**
    - `$wikis`: A string representing the wiki to add to the query.

## 7. `offset($offset): self`

Set a result offset.

- **Parameters:**
    - `$offset`: An integer representing the offset for results.

## 8. `orderBy($orderBy): self`

Order the results.

- **Parameters:**
    - `$orderBy`: A string representing the order for the results.

## Return Type

- All methods, except `get()`, return an instance of the class implementing the interface (`self`).

- The `get()` method returns an array of key-value pairs representing the query results.

---

**Note:** This documentation assumes the PHP code follows the standard conventions for method usage. Ensure that the implementation adheres to these conventions for accurate usage.


## API

```php
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
    public function addWiki(string $wikis): self;

    /**
     * Set a result offset.
     */
    public function offset(int $offset): self;

    /**
     * Order the results.
     */
    public function orderBy(string $orderBy): self;
}


```
