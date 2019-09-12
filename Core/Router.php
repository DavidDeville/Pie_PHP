<?php

namespace Core;

/*
**  Router redirects to the right controller and its method depending
**  on the URL. 
**
*/
class Router
{
    /**
     *  Saves all the routes containing a controller & method 
     *  in the according key (url) of the array (routes)
     */
    private static $routes;
    public static function connect($url, $route)
    {
        
        self::$routes[$url] = $route;
        // echo "<pre> route vaut ";
        // var_dump($route);
        // echo "</pre>";
        
        // echo "<pre> routes vaut ";
        // var_dump(self::$routes);
        // echo "</pre>";
    }

    /**
     *  Return an associative array containing the route of specified url
     * 
     *  @return array - An array containing all route of the current url
     *  @return null - Null otherwise
     */
    public static function get($url)
    {
        // echo "ROUTES VAUT : ";
        // echo "<pre>";
        // var_dump(self::$routes[$url]);
        // echo "</pre>";
        if(array_key_exists($url, self::$routes))
        {
            // echo "<pre> Routes vaut : ";
            // var_dump(self::$routes[$url]);
            // echo "</pre>";
            return(self::$routes[$url]);
        }
        else
        {
            return null;
        }
    }
}