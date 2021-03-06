<?php

namespace Core;

/*
**  Core is the core of the program & can be considered as the main controller
*/
class Core
{
    public function __construct()
    {
    }


    /**
     * Static Router
     * 
     * Checks if the route exist, returns null if that's not the case
     * Else, the controller is initialized
     * Checks if the method exist and applies if is found
     * Otherwise display error 404, method not found
     * 
     */
    public function run()
    {
        include 'src/routes.php';
        $url = explode('/PiePHP', $_SERVER['REQUEST_URI']);
        /*echo "URL VAUT : ";
        echo "<pre>";
        var_dump($url);
        echo "</pre>";*/
        //$route = array_filter($route);
        // echo "<pre>";
        // echo "Valeur : ";
        // print_r($route);
        // echo "</pre>";
        $route = Router::get($url[1]);
        // echo "ROUTE VAUT : ";
        // echo "<pre>";
        // var_dump($route);
        // echo "</pre>";
        $controllerName = 'src\\Controller\\' . ucfirst($route['controller']) . 'Controller';
        $actionName = $route['action'] . 'Action';
        if($route == null) {
            die("404 - The path does not exist");
        }
        else {
            if(class_exists($controllerName)) {
                $controller = new $controllerName;
                if(method_exists($controller, $actionName)) {
                    $controller->$actionName();
                }
                else {
                    echo "404 - Method does not exist";
                }
            }
            else {
                echo "404 - Controller does not exist";
            }
        }        
    }

    /**
     * Dynamic Router
     * 
     * Checks if the route exist, returns null if that's not the case
     * Else, the controller is initialized
     * Checks if the method exist and applies if
     * Otherwise display error 404, method not found
     */
    // public function run()
    // {
    //     $params = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);        
    //     $params = array_filter($params);
        
    //     echo '<pre>';
    //     var_dump($params);
    //     echo '</pre>';

    //     if (isset($params[2])) {
    //         $controllerClass = $params[2];
    //     } else {
    //         $controllerClass = 'app';
    //     }
    //     $controllerClass = 'src\\Controller\\' . ucfirst($controllerClass) . 'Controller';
    //     echo "valeur de controllerClass : " . $controllerClass . "<br>";
        
    //     $controllerFile = dirname(__DIR__) . '/' . str_replace('\\', '/', $controllerClass) . '.php';

    //     if (file_exists($controllerFile)) {
    //         $controller  = new $controllerClass();
    //     } else {
    //         die('404 - Class ' . $controllerClass . ' not found');
    //     }

    //     if (isset($params[3])) {
    //         $action = $params[3];
    //     } else {
    //         $action = 'index';
    //     }

    //     if (method_exists($controller, $action . 'Action')) {
    //         $action .= 'Action';
    //     } else {
    //         die('404 - Method ' . $controllerClass . '::' . $action . ' not found');    
    //     }

    //     $controller->$action();
    // }
}