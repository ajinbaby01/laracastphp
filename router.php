<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/laracastphp/' => 'controllers/index.php',
    '/laracastphp/about' => 'controllers/about.php',
    '/laracastphp/notes' => 'controllers/notes.php',
    '/laracastphp/note' => 'controllers/note.php',
    '/laracastphp/contact' => 'controllers/contact.php'
];

function abort($responseCode = Response::HTTP_NOT_FOUND)
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
