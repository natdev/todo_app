<?php
namespace Manager;

use Entity\task;

class taskManager extends \connexion {

    public function addTask(task $task){

        $q = $this->bdd->prepare('INSERT INTO taches(tache, createdAt, Users_id) VALUES (:tache, :createdAt, :userId)');
        $q->bindValue(':tache', $task->getTache());
        $q->bindValue(':createdAt', $task->getCreatedAt());
        $q->bindValue(':userId', $task->getUserId(), \PDO::PARAM_INT);

        $q->execute();
    }

    public function deleteTask(task $task){
        $this->bdd->exec('DELETE FROM taches WHERE id = '.$task->getId());
    }

    public function getTask($id){
        $id = (int) $id;

        $q = $this->bdd->query('SELECT tache FROM taches WHERE id = '.$id);
        $donnees =  $q->fetch(\PDO::FETCH_ASSOC);
        return new tache($donnees);
    }

    public function getTasks(){
        $tasks = [];

        $q = $this->bdd->query('SELECT * FROM taches');

        while($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
            $tasks[] = new task($donnees);
        }

        return $tasks;
    }

    public function getTasksUser($id){
        $tasks = [];

        $q = $this->bdd->query('SELECT * FROM taches WHERE Users_id = '.$id);

        while($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
            $tasks[] = new task($donnees);
        }

        return $tasks;
    }

    public function updateTask(task $task){
        $q = $this->bdd->prepare('UPDATE taches SET tache = :tache WHERE id = :id');
        $q->bindValue(':tache', $task->getTache() );
        $q->bindValue(':id', $task->getId());
        $q->execute();
    }

}