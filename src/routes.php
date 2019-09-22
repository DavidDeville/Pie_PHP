<?php

use \Core\Router;

/**
 * Different urls & routes usable by the router
 * URL is the first parameter of the connect method & the second parameter is the route
 * containing the controller to use and its method
 */
Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'register']);
Router::connect('/login', ['controller' => 'user', 'action' => 'login']);
Router::connect('/user', ['controller' => 'user', 'action' => 'show']);