# Wiki

The following PHP code defines a `Wiki` class that encapsulates various constants representing different wikis related to specific game titles or genres. Similar to the `Endpoint` class for Liquipedia API endpoints, the `Wiki` class provides a convenient way to access and reference the available wikis.

## Usage

```php
<?php

use Npldevfr\Liquipedia\Meta\Wiki;

// Get all available wikis
$wikis = Wiki::all();

// Get a specific wiki
$dota2Wiki = Wiki::DOTA_2;
```

## List of Available Wikis

- `Wiki::AGE_OF_EMPIRES`
- `Wiki::APEX_LEGENDS`
- `Wiki::ARENA_FPS`
- `Wiki::ARENA_OF_VALOR`
- `Wiki::ARTIFACT`
- `Wiki::AUTO_CHESS`
- `Wiki::BATTALION_1944`
- `Wiki::BATTLERITE`
- `Wiki::BRAWLHALLA`
- `Wiki::BRAWL_STARS`
- `Wiki::CALL_OF_DUTY`
- `Wiki::CLASH_OF_CLANS`
- `Wiki::CLASH_ROYALE`
- `Wiki::COUNTER_STRIKE`
- `Wiki::CRITICAL_OPS`
- `Wiki::CROSSFIRE`
- `Wiki::DOTA_2`
- `Wiki::FIFA`
- `Wiki::FIGHTING_GAMES`
- `Wiki::FORMULA_1`
- `Wiki::FORTNITE`
- `Wiki::FREE_FIRE`
- `Wiki::HALO`
- `Wiki::HEARTHSTONE`
- `Wiki::HEROES_OF_THE_STORM`
- `Wiki::ILLUVIUM`
- `Wiki::LEAGUE_OF_LEGENDS`
- `Wiki::MAGIC_THE_GATHERING`
- `Wiki::MOBILE_LEGENDS_BANG_BANG`
- `Wiki::NARAKA`
- `Wiki::OMEGA_STRIKERS`
- `Wiki::OSU`
- `Wiki::OVERWATCH`
- `Wiki::PALADINS`
- `Wiki::POKEMON`
- `Wiki::PUBG`
- `Wiki::PUBG_MOBILE`
- `Wiki::RAINBOW_SIX`
- `Wiki::ROCKET_LEAGUE`
- `Wiki::LEGENDS_OF_RUNETERRA`
- `Wiki::ROCKET_LEAGUE_SIDESWIPE`
- `Wiki::SIM_RACING`
- `Wiki::SMASH`
- `Wiki::SMITE`
- `Wiki::SPLATOON`
- `Wiki::SPLITGATE`
- `Wiki::STAR_WARS_SQUADRONS`
- `Wiki::STARCRAFT_BROOD_WAR`
- `Wiki::STARCRAFT_2`
- `Wiki::STORMGATE`
- `Wiki::TEAM_FORTRESS`
- `Wiki::TETRIS`
- `Wiki::TEAMFIGHT_TACTICS`
- `Wiki::TRACKMANIA`
- `Wiki::DOTA_UNDERLORDS`
- `Wiki::VALORANT`
- `Wiki::WARCRAFT`
- `Wiki::WILD_RIFT`
- `Wiki::WORLD_OF_TANKS`
- `Wiki::WORLD_OF_WARCRAFT`
- `Wiki::ZULA`

## Reference

```php
<?php

namespace Npldevfr\Liquipedia\Meta;

use Npldevfr\Liquipedia\Traits\HasConstants;

final class Wiki
{
    use HasConstants;

    final public const AGE_OF_EMPIRES = 'ageofempires';

    final public const APEX_LEGENDS = 'apexlegends';

    final public const ARENA_FPS = 'arenafps';

    final public const ARENA_OF_VALOR = 'arenaofvalor';

    final public const ARTIFACT = 'artifact';

    final public const AUTO_CHESS = 'autochess';

    final public const BATTALION_1944 = 'battalion';

    final public const BATTLERITE = 'battlerite';

    final public const BRAWLHALLA = 'brawlhalla';

    final public const BRAWL_STARS = 'brawlstars';

    final public const CALL_OF_DUTY = 'callofduty';

    final public const CLASH_OF_CLANS = 'clashofclans';

    final public const CLASH_ROYALE = 'clashroyale';

    final public const COUNTER_STRIKE = 'counterstrike';

    final public const CRITICAL_OPS = 'criticalops';

    final public const CROSSFIRE = 'crossfire';

    final public const DOTA_2 = 'dota2';

    final public const FIFA = 'fifa';

    final public const FIGHTING_GAMES = 'fighters';

    final public const FORMULA_1 = 'formula1';

    final public const FORTNITE = 'fortnite';

    final public const FREE_FIRE = 'freefire';

    final public const HALO = 'halo';

    final public const HEARTHSTONE = 'hearthstone';

    final public const HEROES_OF_THE_STORM = 'heroes';

    final public const ILLUVIUM = 'illuvium';

    final public const LEAGUE_OF_LEGENDS = 'leagueoflegends';

    final public const MAGIC_THE_GATHERING = 'magic';

    final public const MOBILE_LEGENDS_BANG_BANG = 'mobilelegends';

    final public const NARAKA = 'naraka';

    final public const OMEGA_STRIKERS = 'omegastrikers';

    final public const OSU = 'osu';

    final public const OVERWATCH = 'overwatch';

    final public const PALADINS = 'paladins';

    final public const POKEMON = 'pokemon';

    final public const PUBG = 'pubg';

    final public const PUBG_MOBILE = 'pubgmobile';

    final public const RAINBOW_SIX = 'rainbowsix';

    final public const ROCKET_LEAGUE = 'rocketleague';

    final public const LEGENDS_OF_RUNETERRA = 'runeterra';

    final public const ROCKET_LEAGUE_SIDESWIPE = 'sideswipe';

    final public const SIM_RACING = 'simracing';

    final public const SMASH = 'smash';

    final public const SMITE = 'smite';

    final public const SPLATOON = 'splatoon';

    final public const SPLITGATE = 'splitgate';

    final public const STAR_WARS_SQUADRONS = 'squadrons';

    final public const STARCRAFT_BROOD_WAR = 'starcraft';

    final public const STARCRAFT_2 = 'starcraft2';

    final public const STORMGATE = 'stormgate';

    final public const TEAM_FORTRESS = 'teamfortress';

    final public const TETRIS = 'tetris';

    final public const TEAMFIGHT_TACTICS = 'tft';

    final public const TRACKMANIA = 'trackmania';

    final public const DOTA_UNDERLORDS = 'underlords';

    final public const VALORANT = 'valorant';

    final public const WARCRAFT = 'warcraft';

    final public const WILD_RIFT = 'wildrift';

    final public const WORLD_OF_TANKS = 'worldoftanks';

    final public const WORLD_OF_WARCRAFT = 'worldofwarcraft';

    final public const ZULA = 'zula';
}

```
