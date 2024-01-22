<?php

namespace KCNetwork\Liquipedia\Endpoints;

enum Endpoints: string
{
    case BROADCASTERS = '/v3/broadcasters';
    case COMPANIES = '/v3/company';
    case DATAPOINTS = '/v3/datapoint';
    case EXTERNAL_MEDIA_LINKS = '/v3/externalmedialink';
    case MATCHES = '/v3/match';
    case PLACEMENTS = '/v3/placement';
    case PLAYERS = '/v3/player';
    case SERIES = '/v3/series';
    case SQUAD_PLAYERS = '/v3/squadplayer';
    case STANDINGS_ENTRY = '/v3/standingsentry';
    case STANDINGS_TABLE = '/v3/standingstable';
    case TEAMS = '/v3/team';
    case TOURNAMENTS = '/v3/tournament';
    case TRANSFERS = '/v3/transfer';
    case TEAM_TEMPLATES = '/v3/teamtemplate';
    case TEAM_TEMPLATE_LIST = '/v3/teamtemplatelist';
}
