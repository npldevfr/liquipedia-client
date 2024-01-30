---
outline: deep
---

## What is Liquipedia PHP Client?

The Liquipedia PHP Client serves as a PHP software development kit (SDK) designed to simplify and enhance the utilization of the latest Liquipedia v3 API through custom methods and endpoints.

## Example

```php
<?php

use Npldevfr\Liquipedia\Liquipedia;
use Npldevfr\Liquipedia\Meta\Endpoint;
use Npldevfr\Liquipedia\Meta\Wiki;

$liquipediaSdk = new Liquipedia('your-api-key');

// Get the last 10 matches of Team Liquid on League of Legends
$matches = $liquipediaSdk->query()
        ->endpoint(Endpoint::MATCHES)
        ->wikis(Wiki::LEAGUE_OF_LEGENDS)
        ->rawConditions('[[opponent::Team Liquid]]')
        ->limit(10)
        ->orderBy('date', 'desc')
        ->get();
    
    
```

## Roadmap

The Liquipedia PHP Client is currently in development and is not yet ready for production use. The following features are planned for the first release:

| Feature                   | Status |
|---------------------------|--------|
| Liquipedia API v3 support | ✅      |
| Custom query builder      | ✅      |
| Extensible                | ✅      |
| Documentation             | ❌      |
| Examples                  | ❌      |
| Tests                     | ✅      |
| Endpoint methods          | ❌      |
| Endpoint classes          | ❌      |




