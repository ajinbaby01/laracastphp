<?php
use Core\Session;
use Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . '/../';

// Loads classes automatically when required
require BASE_PATH . 'vendor/autoload.php'; // Composer autoloader

// spl_autoload_register(function ($class) {

//     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

//     require base_path("{$class}.php");
// });

require BASE_PATH . 'Core/functions.php';

require base_path('bootstrap.php');

$router = new Core\Router();

require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('old', [
        'email' => $exception->old['email']
    ]);

    Session::flash('errors', $exception->errors);

    redirect($router->previousUrl());
}

Session::unflash();

?>
