<?php
/**
 * Autoloader for classes.
 *
 * @param string $class the name of the class.
 */
spl_autoload_register(function ($class) {
    //echo "$class<br>";
    $path = __DIR__ . "/../src/{$class}.php";
    if (is_file($path)) {
        include($path);
    }
});
