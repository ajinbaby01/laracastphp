<?php

namespace Core;

class Router
{

    protected $routes = []; //caching the routes when Router methods are called from routes.php

    protected function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');

    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] == strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($responseCode = Response::HTTP_NOT_FOUND)
    {
        http_response_code($responseCode);
        require base_path("views/{$responseCode}.php");
        exit;
    }

}

?>
