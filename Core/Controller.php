<?php

namespace Core;

abstract class Controller
{
    /**
     * @var string $_render - content of the view
     */
    protected static $_render = '';

    /*
    **  Echo the render & destroys it after its displayed
    */
    public function __destruct()
    {
        echo self::$_render;
    }

    /**
     * Render method
     * 
     * @param string $view - the selected view
     * 
     * @param array $scope - Associative array containing specific words
     * and their values
     * Each key becomes a variable and the content of variable is the value
     * 
     * If the file exists, adds the file content (view) in the layout
     * Echo file does not exist otherwise
     */
    protected function render($view, $scope = []) {
        extract($scope);
        $controller = basename(str_replace('\\', '/', get_class($this))); // --> UserController 
        $controller = str_replace('Controller', '', $controller); // --> User
        $file = 'src/View/' . $controller . '/' . $view . '.php'; // --> View file
        //var_dump($file);
        if (file_exists($file)) {
            ob_start();
            include($file);
            $view = ob_get_clean();
            ob_start();
            include(
                implode(
                    DIRECTORY_SEPARATOR, [
                        dirname(__DIR__), 
                        'src', 
                        'View', 
                        'index'
                    ]
                ) . '.php'); // --> layout file
            self::$_render = ob_get_clean();
            //var_dump(self::$_render);
        } else {
            echo $file . ' does not exist';
        }
        // echo "F vaut : <br>";
        // var_dump($file);
    }
}