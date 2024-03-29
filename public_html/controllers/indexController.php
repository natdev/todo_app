<?php

use Entity\task;
use Manager\taskManager;


class indexController {
    function indexAction($twig){

        if($_SESSION){
            extract($_SESSION);
            if(isset($lastname)){
                $lastname = $lastname;
            }

            if(isset($firstname)){
                $firstname = $firstname;
            }

            if(isset($id)){
                $id = $id;

                $manager = new taskManager();
                $taches = $manager->getTasksUser($id);
            }
        }



        echo $twig->render('index.html.twig',[
            'titre'=> 'hello world',
            'lastname' => (isset($lastname) ? $lastname : null),
            'firstname' => (isset($firstname) ? $firstname : null),
            'id' => (isset($id) ? $id : null),
            'taches' => (isset($taches) ? $taches : null)
            ]);
    }

    public function tacheAction($twig){

        if($_POST) {
            extract($_POST);
            if (isset($tache_val) && isset($id)) {

                $createdAt = new DateTime();
                $tache = new task([
                    'tache' => $tache_val,
                    'createdAt' => $createdAt->format('Y-m-d H:i:s'),
                    'userId' => $id
                ]);

                $manager = new taskManager();
                $manager->addTask($tache);
            }

            if(isset($id)){
                $manager = new taskManager();
                $taches = $manager->getTasksUser($id);
            }
            else{
                echo "<h3 class=\"text-center text-success\">Vous devez être connecté pour ajouter une tâche</h3>";
            }
        }





        echo $twig->render('taches.html.twig', [
            'taches' =>(isset($taches) ? $taches : null),
            'id'    => (isset($id) ? $id : null)
        ]);
    }

    public function updateAction(){

        if($_GET) {
            extract($_GET);
            if (isset($id_task) && isset($val)) {
                $id_task = htmlspecialchars($id_task);
                $val = htmlspecialchars($val);


                $manager = new taskManager();
                $tache = $manager->getTask($id_task);
                $tache->setTache($val);
                $manager->updateTask($tache);
            }

        }

    }

    public function deleteAction($twig){

        if($_GET) {
            extract($_GET);
            if (isset($id_task) && isset($id)) {
                $id_task = htmlspecialchars($id_task);
                $id = htmlspecialchars($id);


                $manager = new taskManager();
                $tache = $manager->getTask($id_task);
                $manager->deleteTask($tache);
            }


            $manager = new taskManager();
            $taches = $manager->getTasksUser($id);
        }





        echo $twig->render('taches.html.twig', ['taches' => $taches]);
    }
}

