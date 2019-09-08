<?php

use \Core\Router;

// connexion d'une URL à une route
Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Router::connect('/user', ['controller' => 'user', 'action' => 'display']);