<?php

ini_set('display_errors', 1);

// echo "<br>";
// echo "SERVER vaut : ";
// echo "<pre>";
// print_r($_SERVER);
// echo "GET vaut : ";
// echo "</pre>";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
// echo "POST vaut : ";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

define('BASE_URI', str_replace('\\', '/', substr(__DIR__,
strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
//Il défini une constante et il remplace les \\ par des / et 


$app = new Core\Core();
$app->run();

// $kebab = new Controller\AppController();
// $kebab->speak();

//php -S localhost:1234
?>