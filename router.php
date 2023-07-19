<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/laracastphpdemo/' => 'controllers/index.php',
    '/laracastphpdemo/about' => 'controllers/about.php',
    '/laracastphpdemo/contact' => 'controllers/contact.php'
];

function abort($responseCode = 404)
{
    http_response_code($responseCode);
    require "views/{$responseCode}.php";
}

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

routeToController($uri, $routes);

?>
