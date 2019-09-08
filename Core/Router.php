<?php

namespace Core;

class Router
{
    private static $routes;
    public static function connect($url, $route)
    {
        self::$routes[$url] = $route;
        
        
    }

    public static function get($url)
    {
        echo "ROUTES VAUT : ";
        echo "<pre>";
        var_dump(self::$routes);
        echo "</pre>";
        if(array_key_exists($url, self::$routes))
        {
            return(self::$routes[$url]);
        }
        else
        {
            return null;
        }
    }
}