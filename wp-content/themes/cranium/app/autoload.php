<?php

spl_autoload_register(function($name) {
    $name = str_replace('\\', '/', str_replace('_', '-', strtolower($name)));
    $file = dirname(__FILE__).'/'.$name.'.php';
    if (file_exists($file)) require $file;
});

$app = new Application();

$functions_path = TEMPLATEPATH.'/functions';

set_include_path(join(PATH_SEPARATOR, [
    get_include_path(),
    $functions_path
]));

$dir = opendir($functions_path);
while($file = readdir($dir)) {
    if($file[0] == '.') continue;
    require_once $file;
}
closedir($dir);