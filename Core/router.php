<?php

use Core\Response;

$routes = require base_path('routes.php');

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);

?>