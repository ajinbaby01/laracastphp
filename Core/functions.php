<?php

use Core\Response;

function isUrl($value)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $value;
}

function dd($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
    exit;
}

function abort($responseCode = Response::HTTP_NOT_FOUND)
{
    http_response_code($responseCode);
    require base_path("views/{$responseCode}.php");
    exit;
}

function authorize($condition)
{
    if (!$condition) {
        abort(Response::HTTP_FORBIDDEN);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{

    extract($attributes);

    require base_path('views/' . $path);
}

function login($user)
{
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = [
        'email' => $user['email']
    ];
}
