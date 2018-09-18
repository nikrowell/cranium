<?php

class Request {

    public $body;
    public $params;
    public $query;
    public $headers;

    public function __construct() {

        $body = json_decode(file_get_contents('php://input'), true);
        $body = array_merge($_POST, is_array($body) ? $body : []);

        $this->body = $body;
        $this->params = [];
        $this->query = array_map([$this, 'decode'], $_GET);
        $this->headers = getallheaders();
    }

    public function __get($key) {

        switch ($key) {
            case 'method':
                return $_SERVER['REQUEST_METHOD'];
            case 'url':
                return $_SERVER['REQUEST_URI'];
            case 'ip':
                return $_SERVER['REMOTE_ADDR'];
            case 'ua':
                return $_SERVER['HTTP_USER_AGENT'];
            case 'xhr':
                return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        }
    }

    public function header($key, $fallback = null) {
        return $this->headers[$key] ?? $fallback;
    }

    public function param($key, $fallback = null) {
        return $this->params[$key] ?? $fallback;
    }

    public function query($key, $fallback = null) {
        return $this->query[$key] ?? $fallback;
    }

    public function body($key, $fallback = null) {
        return $this->body[$key] ?? $fallback;
    }

    private function decode($value) {
        if ($value === 'true') {
            return true;
        } else if ($value === 'false') {
            return false;
        } else if ($value === 'null') {
            return null;
        } else if (is_numeric($value)) {
            return (float) $value;
        }
        return $value;
    }
}