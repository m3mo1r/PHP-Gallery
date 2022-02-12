<?php
function class_autoloader($class) {
    $file = strtolower($class) . '.php';
    $path = "includes/{$file}";
    
    if(is_file($path) && !class_exists($class))
        require_once($path);
    else
        die("File {$file} not existed.");
}
spl_autoload_register('class_autoloader');

function redirect($loc) { header("Location: {$loc}");}

function is_empty($str) { return empty(trim($str));}
?>