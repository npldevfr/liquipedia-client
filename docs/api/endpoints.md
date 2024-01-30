# Endpoints

The following PHP code defines an `Endpoint` class that encapsulates various constants representing different endpoints related to specific aspects of esports data. Similar to the `Wiki` class for Liquipedia API wikis, the `Endpoint` class provides a convenient way to access and reference the available endpoints.  

## Usage

```php
<?php

use Npldevfr\Liquipedia\Meta\Endpoint;

// Get all endpoints
$endpoints = Endpoint::all();

// Get a specific endpoint
$matchEndpoint = Endpoint::MATCHES;

```

## List of Available Endpoints

- `Endpoint::BROADCASTERS`
- `Endpoint::COMPANIES`
- `Endpoint::DATAPOINTS`
- `Endpoint::EXTERNAL_MEDIA_LINKS`
- `Endpoint::MATCHES`
- `Endpoint::PLACEMENTS`
- `Endpoint::PLAYERS`
- `Endpoint::SERIES`
- `Endpoint::SQUAD_PLAYERS`
- `Endpoint::STANDINGS_ENTRY`
- `Endpoint::STANDINGS_TABLE`
- `Endpoint::TEAMS`
- `Endpoint::TOURNAMENTS`
- `Endpoint::TRANSFERS`
- `Endpoint::TEAM_TEMPLATES`
- `Endpoint::TEAM_TEMPLATE_LIST`

## Reference

```php
<?php

namespace Npldevfr\Liquipedia\Meta;

use Npldevfr\Liquipedia\Traits\HasConstants;

final class Endpoint
{
    use HasConstants;

    final public const BROADCASTERS = 'broadcasters';

    final public const COMPANIES = 'company';

    final public const DATAPOINTS = 'datapoint';

    final public const EXTERNAL_MEDIA_LINKS = 'externalmedialink';

    final public const MATCHES = 'match';

    final public const PLACEMENTS = 'placement';

    final public const PLAYERS = 'player';

    final public const SERIES = 'series';

    final public const SQUAD_PLAYERS = 'squadplayer';

    final public const STANDINGS_ENTRY = 'standingsentry';

    final public const STANDINGS_TABLE = 'standingstable';

    final public const TEAMS = 'team';

    final public const TOURNAMENTS = 'tournament';

    final public const TRANSFERS = 'transfer';

    final public const TEAM_TEMPLATES = 'teamtemplate';

    final public const TEAM_TEMPLATE_LIST = 'teamtemplatelist';
}

```
