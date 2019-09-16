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
    }

    /**
     *  Return an associative array containing the route of specified url
     * 
     *  @return array - An array containing all route of the current url
     *  @return null - Null otherwise
     */
    public static function get($url)
    {
        if(array_key_exists($url, self::$routes)) {
            return(self::$routes[$url]);
        }
        else {
            return null;
        }
    }
}