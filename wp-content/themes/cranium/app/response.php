<?php

// TODO: add namespacing
// use Cranium\Response;

class Response {

    public function header($headers, $value = null) {
        if (!is_array($headers)) {
            $headers = [$headers => $value];
        }
        foreach ($headers as $key => $value) {
            header("$key: $value");
        }
        return $this;
    }

    public function status($http_status) {
        http_response_code($http_status);
        return $this;
    }

    public function json($data) {
        $this->header('Content-Type', 'application/json');
        exit(json_encode($data));
    }

    public function send($data = null) {
        if (is_array($data)) {
            return $this->json($data);
        }
        $this->header('Content-Type', 'text/html');
        exit(empty($data) ? ' ' : $data);
    }

    public function render($template, $data = []) {

        $template = ltrim($template, '/');
        $template = str_replace('.php', '', $template);
        $template = TEMPLATEPATH.'/'.$template.((strpos($template, '.html') ? '' : '.php'));

        if (!file_exists($template)) {
            trigger_error('template "'.$template.'" does not exist', E_USER_ERROR);
        }

        ob_start();
        extract($data);
        include($template);
        $html = ob_get_clean();

        $this->send($html);
    }

    public function redirect($url, $status = 302) {
        header("Location: $url", true, $status);
        exit;
    }
}