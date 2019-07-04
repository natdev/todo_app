<?php


$tab = explode('/', $url);
array_shift($tab);

$controller = $tab[0].'Controller';
$controller_file = $tab[0].'Controller.php';
$path_controller = $path.'\\controllers\\'.$controller_file;

/*condition qui exclus les article car ils ont un autre template*/
if(file_exists($path_controller) && isset($tab[1])){

    $action = $tab[1].'Action';

    require $path_controller;

    if(class_exists($controller)){
        $controller = new $controller();
        if(method_exists($controller, $action)){
         $controller->$action($twig);
        }
    }

}
else{
    require $path.'\\controllers\\indexController.php';
    if(class_exists('indexController')){
        $controller= new indexController();
        if(method_exists($controller,'indexAction')){


            $controller->indexAction($twig);


        }
    }

}


