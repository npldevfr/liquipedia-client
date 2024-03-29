<br />

<p align="center">

<img src="./docs/images/dark.png#gh-dark-mode-only" width="180" />
<img src="./docs/images/light.png#gh-light-mode-only" width="180"  />
</p>
<h3  align="center">
Liquipedia PHP Client
</h3>
<p  align="center">
An unofficial PHP client for the <a href="https://liquipedia.net">Liquipedia</a> API.
<p>

<div align="center">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/npldevfr/liquipedia-client.svg?style=flat-square)](https://packagist.org/packages/npldevfr/liquipedia-client)
[![Tests](https://img.shields.io/github/actions/workflow/status/npldevfr/liquipedia-client/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/npldevfr/liquipedia-client/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/npldevfr/liquipedia-client.svg?style=flat-square)](https://packagist.org/packages/npldevfr/liquipedia-client)
</div>

## ✨ Features

👌&nbsp; Easy to use<br>
🔥&nbsp; Supports all Liquipedia API endpoints<br>
🔨&nbsp; Custom query builder<br>
🧩&nbsp; Extensible<br>
📚&nbsp; Well documented<br>
🧪&nbsp; Tested<br>

## 📦 Installation

Supports PHP >= 8.2

```bash
composer require npldevfr/liquipedia-client
```

## 🚀 Usage

```php
use Npldevfr\Liquipedia\ConditionsBuilder;
use Npldevfr\Liquipedia\Liquipedia;
use Npldevfr\Liquipedia\Meta\Endpoint;
use Npldevfr\Liquipedia\Meta\Wiki;

$liquipediaSdk = new Liquipedia('your-api-key');

// Get the last 10 matches of Team Liquid
$matches = $liquipediaSdk->query()
        ->endpoint(Endpoint::MATCHES)
        ->wikis(Wiki::LEAGUE_OF_LEGENDS)
        ->rawConditions('[[opponent::Team Liquid]]')
        ->limit(10)
        ->orderBy('date', 'desc')
        ->get()
    );
```

## 🛠️ Development

```bash
git clone https://github.com/npldevfr/liquipedia-client
composer install

composer test
```

