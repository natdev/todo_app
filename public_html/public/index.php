<?php
session_start();
/*définition des constantes*/
define('URL', $_SERVER['REQUEST_URI']);
$url = URL;
define('BASE_URL', $_SERVER['SERVER_NAME']);
$path = dirname(__DIR__);
$template = "default";

/*Integration des fichiers nécessaires au fonctionnement de l'application*/

require_once  $path.'\\config\\core.php';

