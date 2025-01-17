<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_wdt/styles.css' => [[['_route' => '_wdt_stylesheet', '_controller' => 'web_profiler.controller.profiler::toolbarStylesheetAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api' => [[['_route' => 'api_index', '_controller' => 'App\\Controller\\ApiController::index'], null, ['GET' => 0], null, true, false, null]],
        '/api/events' => [
            [['_route' => 'api_events_list', '_controller' => 'App\\Controller\\ApiController::listEvents'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_events', '_controller' => 'App\\Controller\\ApiController::listEvents'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/games' => [
            [['_route' => 'api_games_list', '_controller' => 'App\\Controller\\ApiController::listGames'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_games', '_controller' => 'App\\Controller\\ApiController::listGames'], null, ['GET' => 0], null, false, false, null],
        ],
        '/api/users' => [
            [['_route' => 'api_users_list', '_controller' => 'App\\Controller\\ApiController::listUsers'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_users', '_controller' => 'App\\Controller\\ApiController::listUsers'], null, ['GET' => 0], null, false, false, null],
        ],
        '/event' => [[['_route' => 'app_event_index', '_controller' => 'App\\Controller\\EventController::index'], null, ['GET' => 0], null, true, false, null]],
        '/event/new' => [[['_route' => 'app_event_new', '_controller' => 'App\\Controller\\EventController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/event/api/events' => [[['_route' => 'app_api_events', '_controller' => 'App\\Controller\\EventController::apiEvents'], null, ['GET' => 0], null, false, false, null]],
        '/game' => [[['_route' => 'app_game_index', '_controller' => 'App\\Controller\\GameController::index'], null, ['GET' => 0], null, true, false, null]],
        '/game/new' => [[['_route' => 'app_game_new', '_controller' => 'App\\Controller\\GameController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/search/events' => [[['_route' => 'app_search_events', '_controller' => 'App\\Controller\\SearchController::searchEvents'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\SecurityController::register'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::index'], null, ['GET' => 0], null, false, false, null]],
        '/events' => [[['_route' => 'event_index', '_controller' => 'App\\Controller\\EventController::index'], null, ['GET' => 0], null, false, false, null]],
        '/events/new' => [[['_route' => 'event_new', '_controller' => 'App\\Controller\\EventController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/games' => [[['_route' => 'game_index', '_controller' => 'App\\Controller\\GameController::index'], null, ['GET' => 0], null, false, false, null]],
        '/games/new' => [[['_route' => 'game_new', '_controller' => 'App\\Controller\\GameController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/api/events/([^/]++)(*:222)'
                .'|/event(?'
                    .'|/([^/]++)(?'
                        .'|(*:251)'
                        .'|/(?'
                            .'|details(*:270)'
                            .'|edit(*:282)'
                            .'|join(*:294)'
                            .'|register(*:310)'
                            .'|unregister(*:328)'
                        .')'
                        .'|(*:337)'
                    .')'
                    .'|s/(?'
                        .'|(\\d+)(*:356)'
                        .'|(\\d+)/edit(*:374)'
                        .'|(\\d+)/delete(*:394)'
                    .')'
                .')'
                .'|/game(?'
                    .'|/([^/]++)(?'
                        .'|(*:424)'
                        .'|/edit(*:437)'
                        .'|(*:445)'
                    .')'
                    .'|s/(?'
                        .'|(\\d+)(*:464)'
                        .'|(\\d+)/edit(*:482)'
                        .'|(\\d+)/delete(*:502)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        222 => [[['_route' => 'api_event_details', '_controller' => 'App\\Controller\\ApiController::eventDetails'], ['id'], ['GET' => 0], null, false, true, null]],
        251 => [[['_route' => 'app_event_show', '_controller' => 'App\\Controller\\EventController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        270 => [[['_route' => 'app_event_details', '_controller' => 'App\\Controller\\EventController::details'], ['id'], ['GET' => 0], null, false, false, null]],
        282 => [[['_route' => 'app_event_edit', '_controller' => 'App\\Controller\\EventController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        294 => [[['_route' => 'app_event_join', '_controller' => 'App\\Controller\\EventController::join'], ['id'], ['GET' => 0], null, false, false, null]],
        310 => [[['_route' => 'app_event_register', '_controller' => 'App\\Controller\\EventParticipationController::register'], ['id'], ['POST' => 0], null, false, false, null]],
        328 => [[['_route' => 'app_event_unregister', '_controller' => 'App\\Controller\\EventParticipationController::unregister'], ['id'], ['POST' => 0], null, false, false, null]],
        337 => [[['_route' => 'app_event_delete', '_controller' => 'App\\Controller\\EventController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        356 => [[['_route' => 'event_show', '_controller' => 'App\\Controller\\EventController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        374 => [[['_route' => 'event_edit', '_controller' => 'App\\Controller\\EventController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        394 => [[['_route' => 'event_delete', '_controller' => 'App\\Controller\\EventController::delete'], ['id'], ['DELETE' => 0], null, false, false, null]],
        424 => [[['_route' => 'app_game_show', '_controller' => 'App\\Controller\\GameController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        437 => [[['_route' => 'app_game_edit', '_controller' => 'App\\Controller\\GameController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        445 => [[['_route' => 'app_game_delete', '_controller' => 'App\\Controller\\GameController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        464 => [[['_route' => 'game_show', '_controller' => 'App\\Controller\\GameController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        482 => [[['_route' => 'game_edit', '_controller' => 'App\\Controller\\GameController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        502 => [
            [['_route' => 'game_delete', '_controller' => 'App\\Controller\\GameController::delete'], ['id'], ['DELETE' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
