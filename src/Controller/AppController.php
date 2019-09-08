<?php

namespace src\Controller;
use Core\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        echo "Bienvenue. Vous avez été redirigé sur la page d'accueil via le router";
    }
}
?>