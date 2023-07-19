<?php

require 'functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/laracastphp/' => 'controllers/index.php',
    '/laracastphp/about' => 'controllers/about.php',
    '/laracastphp/contact' => 'controllers/contact.php'
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
