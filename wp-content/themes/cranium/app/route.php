<?php

class Route {

    public $methods;
    public $path;
    public $callback;
    public $params;

    public function __construct($methods, $path, $callback) {
        $this->methods = $methods;
        $this->path = $path;
        $this->callback = $callback;
        $this->params = [];
    }

    public function __invoke(Request $req, Response $res) {
        return call_user_func($this->callback, $req, $res);
    }
}