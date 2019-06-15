<?php

function env($key, $default = null) {

    $value = getenv($key);
    if ($value === false) return $default;

    switch (strtolower($value)) {
        case 'null':  return null;
        case 'true':  return true;
        case 'false': return false;
    }

    if (substr($value, 0, 1) === '"' && substr($value, -1) === '"') {
        return substr($value, 1, -1);
    }

    return $value;
}

$vars = @file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.env');
if ($vars === false) return;

$vars = preg_split("/(\r\n|\n|\r)/", $vars);

foreach ($vars as $line) {
    if (empty($line)) continue;
    list($name, $value) = array_map('trim', explode('=', $line, 2));
    if ($name[0] === '#') continue;
    putenv("$name=$value");
}

unset($vars, $line);