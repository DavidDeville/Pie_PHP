<?php

/*
function coreLoader()
{
    $coreFolders = scandir('Core');
    echo "<pre>";
    print_r($coreFolders);
    echo "</pre>";
    foreach($coreFolders as $file)
    {   
        if($file !== "autoload.php" && $file !== ".." && $file !== ".")
        {
            include 'Core' . DIRECTORY_SEPARATOR . $file;
        }
    }
}

function srcLoader()
{
    $srcFolders = scandir('src');
    echo "<pre>";
    print_r($srcFolders);
    echo "</pre>";
    foreach($srcFolders as $file)
    {   
        if(is_dir($file) && $file !== "." && $file !== "..")
        {
            srcLoader();
        }
    }
}*/

/*
**    le spl autoload register permet d'enregistrer une fonction qui est appelée quand 
**    on instancie un objet à partir d'une classe
*/

spl_autoload_register(function (string $classname) {
    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    if(file_exists($classname . '.php'))
    {
        require_once $classname . '.php';
    }
});

?>