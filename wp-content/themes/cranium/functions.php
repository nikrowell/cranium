<?php

defined('ABSPATH') or die;
require 'app/autoload.php';

$app->get('/work/@slug:[a-zA-Z0-9-]+', function($req, $res) {
    $res->json([
        'method' => $req->method,
        'url' => $req->url,
        'xhr' => $req->xhr,
        'slug' => $req->param('slug'),
        'page' => $req->query('page', 1),
        'ip' => $req->ip,
        'ua' => $req->ua
    ]);
});

$app->post('/contact', function($req, $res) {
    $res->status(422)->json(['message' => 'Validation errors, yo!']);
});