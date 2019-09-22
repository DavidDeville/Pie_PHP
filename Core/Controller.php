<?php

namespace Core;
use Core\Request;

abstract class Controller
{
    /**
     * @var string $_render - content of the view
     */
    protected static $_render = '';
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->request->post_content();
    }

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
    protected function render($view, $scope = []) 
    {
        extract($scope);
        $controller = basename(str_replace('\\', '/', get_class($this))); // --> UserController 
        $controller = str_replace('Controller', '', $controller); // --> User
        $file = 'src/View/' . $controller . '/' . $view . '.php'; // --> View file
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
        } else {
            echo $file . ' does not exist';
        }
    }
}