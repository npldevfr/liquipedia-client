# Builder methods

The ``LiquipediaBuilder`` class is a chainable class that allows you to build a query to send to the API.

> [!WARNING]
> All methods are not usable for all endpoints, please refer to
> the [API documentation](https://api.liquipedia.net/documentation/api/v3/openapi) to see which methods are available for
> each endpoint.

## addWikis()

```php
public function addWikis(string|array $wikis): self
```

``$builder->addWikis()`` is used to add wikis to the query, this method can be called multiple times to add multiple
wikis.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta;

$builder = LiquipediaBuilder::query()
    ->addWikis('leagueoflegends')
    ->addWikis([
        'dota2',
        // Or you can use the Wiki constants
        Wiki::CALL_OF_DUTY
    ])

// Wikis would be :
[
    'wiki' => 'leagueoflegends|dota2|callofduty',
]
```

## build()

```php
public function build(): array
```

``$builder->build()`` is a debug method that returns the query string that would be sent to the API, this is useful for
debugging purposes.

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->endpoint('match')
    ->wikis(['leagueoflegends', 'dota2'])
    ->select(['matchid', 'date'])
    ->limit(10)
    ->rawConditions('opponent', '::', 'Team Liquid')
    ->build();
    
var_dump($builder);

// Output
[
    'wiki' => 'leagueoflegends|dota2',
    'select' => 'matchid,date',
    'conditions' => '([[opponent::Team Liquid]])',
    'limit' => 10,
]
```

## date()

```php
public function date(string $date): self
```

``$builder->date()`` is used to set the date of the query, this method can be called multiple times to add multiple
dates.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->date('2020-01-01')
    
// Date would be :
[
    'date' => '2020-01-01',
]
```

## endpoint()

```php
public function endpoint(string $endpoint): self
```

``$builder->endpoint()`` is used to set the endpoint of the query, this method can be called multiple times to add
multiple endpoints.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta\Endpoint;

$builder = LiquipediaBuilder::query()
    ->endpoint(Endpoint::MATCH)
    
// Or simply :
$builder = LiquipediaBuilder::query()
    ->endpoint('match')

// Endpoint would be :
https://api.liquipedia.net/api/v3/match
```

## get()

```php
public function get(?string $endpoint = null): array
```

``$builder->get()`` is used to send the query to the API, this method can be called multiple times to send multiple
queries.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta\Endpoint;

$builder = LiquipediaBuilder::query()
    ->endpoint(Endpoint::MATCH)
    ->wikis('leagueoflegends')
    ->select(['matchid', 'date'])
    ->limit(10)
    ->rawConditions('opponent', '::', 'Team Liquid')
    ->get();
```

By using the `get()` method, the query is sent to the API and the result is returned as an array.

> [!NOTE]
> You can set the endpoint directly in the `get()` method, this will override the endpoint set by the `endpoint()`
> method.

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;
use Npldevfr\Liquipedia\Meta\Endpoint;

$builder = LiquipediaBuilder::query()
    ->wikis('leagueoflegends')
    ->select(['matchid', 'date'])
    ->limit(10)
    ->rawConditions('opponent', '::', 'Team Liquid')
    ->get(Endpoint::MATCH);
```

## groupBy()

```php
public function groupBy(string $field, string $direction = 'ASC'): self
```

| Parameter  | Type   | Value         | Description                   |
|------------|--------|---------------|-------------------------------|
| $field     | string | *             | The field to group by         |
| $direction | string | `ASC`, `DESC` | The direction of the group by |

``$builder->groupBy()`` is used to set the group by of the query, this method can be called multiple times to add
multiple group by.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->groupBy('date', 'DESC')
    
// Group by would be :
[
    'group_by' => 'date DESC',
]
```

## limit()

```php
public function limit(int $limit): self
```

``$builder->limit()`` is used to set the limit of the query, this method can be called multiple times to add multiple
limits.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->limit(10)
    
// Limit would be :
[
    'limit' => 10,
]
```

## offset()

```php
public function offset(int $offset): self
```

``$builder->offset()`` is used to set the offset of the query, this method can be called multiple times to add multiple
offsets.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->offset(10)
    
// Offset would be :
[
    'offset' => 10,
]
```

## orderBy()

```php
public function orderBy(string $field, string $direction = 'ASC'): self
```

| Parameter  | Type   | Value         | Description                   |
|------------|--------|---------------|-------------------------------|
| $field     | string | *             | The field to order by         |
| $direction | string | `ASC`, `DESC` | The direction of the order by |

``$builder->orderBy()`` is used to set the order by of the query, this method can be called multiple times to add multiple order by.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->orderBy('date', 'DESC')

// Order by would be :
[
    'order_by' => 'date DESC',
]
```

## pagination()
    
```php
public function pagination(int|string $pagination): self
```
    
``$builder->pagination()`` is used to set the pagination of the query, this method can be called multiple times to add multiple pagination.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->pagination(10)

// Pagination would be :

[
    'pagination' => 10,
]
```

## rawConditions()
```php
public function rawConditions(string $conditions): self
```

``$builder->rawConditions()`` is used to set the conditions of the query, this method can be called multiple times to add multiple conditions.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->rawConditions('[[opponent::Team Liquid]]')
    
// Conditions would be :
[
    'conditions' => '[[opponent::Team Liquid]]',
]
```

## select()
    
```php
public function select(string|array $fields): self
```
    
``$builder->select()`` is used to set the select of the query, this method can be called multiple times to add multiple select.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->select(['matchid', 'date'])

// Select would be :
[
    'select' => 'matchid,date',
]
 ```

## template()
```php
public function template(string $template): self
```

``$builder->template()`` is used to set the template of the query, this method can be called multiple times to add multiple templates.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->template('template_name')
    
// Template would be :
[
    'template' => 'template_name',
]
```

## wikis()

```php
public function wikis(string|array $wikis): self
```

``$builder->wikis()`` is used to set the wikis of the query, this method can be called multiple times to add multiple
wikis. If you use this method multiple times, the wikis will overwrite by the last call.

Example :

```php
use Npldevfr\Liquipedia\LiquipediaBuilder;

$builder = LiquipediaBuilder::query()
    ->wikis('leagueoflegends')
    ->wikis([
        'dota2',
        // Or you can use the Wiki constants
        Wiki::CALL_OF_DUTY
    ])

// Wikis would be :
[
    'wiki' => 'dota2|callofduty',
]
```
