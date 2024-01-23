<?php

namespace Npldevfr\Liquipedia\Endpoints;

final class Endpoints
{
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

    /**
     * Check if the endpoint is valid.
     */
    public static function fromArray(string $endpoint): bool
    {
        return in_array($endpoint, self::all());
    }

    /**
     * Get all the endpoints.
     *
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::BROADCASTERS,
            self::COMPANIES,
            self::DATAPOINTS,
            self::EXTERNAL_MEDIA_LINKS,
            self::MATCHES,
            self::PLACEMENTS,
            self::PLAYERS,
            self::SERIES,
            self::SQUAD_PLAYERS,
            self::STANDINGS_ENTRY,
            self::STANDINGS_TABLE,
            self::TEAMS,
            self::TOURNAMENTS,
            self::TRANSFERS,
            self::TEAM_TEMPLATES,
            self::TEAM_TEMPLATE_LIST,
        ];
    }
}
