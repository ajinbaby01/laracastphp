<?php

use Core\Response;

$routes = require base_path('routes.php');

function abort($responseCode = Response::HTTP_NOT_FOUND)
{
    http_response_code($responseCode);
    require base_path("views/{$responseCode}.php");
    exit;
}

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
