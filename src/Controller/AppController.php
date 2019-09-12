<?php

namespace src\Controller;
use Core\Controller;

/**
 * AppController is the controller used by default if no URL has been specified
 */
class AppController extends Controller
{
    /**
     * indexAction displays a welcome message 
     * when the user has been redirected to the main page
     */
    public function indexAction()
    {
        echo "Bienvenue. Vous avez été redirigé sur la page d'accueil via le router";
    }
}
?>