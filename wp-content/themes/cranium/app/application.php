<?php

class Application {

    private static $pattern = '#@([\w]+)(:([^/\(\)]*))?#';
    private static $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    private $routes = [];
    private $base = '/';

    public function __construct() {
        add_action('do_parse_request', [$this, 'run']);
    }

    public function init($options) {
        if (isset($options['base'])) {
            $this->base = '/'.ltrim($options['base'], '/');
        }
    }

    public function __call($method, $args) {
        $method = strtoupper($method);
        if (!in_array($method, self::$methods)) {
            trigger_error('Invalid method "'.$method.'"', E_USER_ERROR);
        }
        // TODO: allow passing in a URL to exceucte internal endpoints?
        // if (empty($args[1])) {
        //     $this->route([$method], $args[0], $args[1]);
        //     return;
        // }
        $this->route([$method], $args[0], $args[1]);
    }

    public function all($path, $callback) {
        $this->route(self::$methods, $path, $callback);
    }

    // TODO: use this to add support for middleware (callback only)?
    public function route($methods, $path, $callback) {
        $path = $this->base.trim($path, '/');
        $this->routes[] = new Route($methods, $path, $callback);
    }

    // TODO: allow passing in a URL to exceucte internal endpoints?
    public function run() {

        if (is_admin()) return true;

        $method = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : $_SERVER['REQUEST_METHOD'];
        $url = '/'.trim($_SERVER['REQUEST_URI'], '/');
        $req = new Request();
        $res = new Response();

        $res->header([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => join(',', self::$methods),
            'Access-Control-Allow-Headers' => 'Accept, Content-Type, X-Method-Override, X-Requested-With'
        ]);

        $route = $this->match($method, $url);
        $state = [];

        if ($route) {
            $req->params = $route->params;
            $state = $route($req, $res);
        }

        $res->render('index', $state);
    }

    private function match($method, $url) {

        foreach($this->routes as $route) {

            if (!in_array($method, $route->methods)) {
                continue;
            }

            $path = str_replace(')', ')?', $route->path);
            $params = [];
            $matches = [];

            $regex = preg_replace_callback(self::$pattern, function($matches) use (&$params) {
                $params[$matches[1]] = null;
                return (isset($matches[3])) ? '(?P<'.$matches[1].'>'.$matches[3].')' : '(?P<'.$matches[1].'>[^/\?]+)';
            }, $path);

            if (preg_match('#^'.$regex.'(?:\?.*)?$#i', $url, $matches)) {

                foreach($matches as $key => $value) {
                    if (array_key_exists($key, $params)) {
                        $route->params[$key] = urldecode($value);
                    }
                }

                return $route;
            }
        }

        return false;
    }
}