<?php

/**
 * spl autoload register is stocking a method that is called whenever
 * a new object has been initialized
 * 
 * @param string $classname - Namespace & classname of the initialized object
 */

spl_autoload_register(function ($classname) {
    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    //var_dump($classname);
    if(file_exists($classname . '.php'))
    {
        require_once $classname . '.php';
    }
});

// function autoload(string $classname)
// {
//     $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
//     if(file_exists($classname . '.php'))
//     {
//         require_once $classname . '.php';
//     }
// }
// spl_autoload_register('autoload');
?>