<?php
namespace Manager;



use Entity\user;

class userManager extends \connexion {

    public function addUser(user $user){

        $q = $this->bdd->prepare('INSERT INTO users(firstname, lastname, email, password, createdAt) VALUES (:firstname, :lastname, :email, :password, :createdAt)');
        $q->bindValue(':firstname', $user->getFirstname());
        $q->bindValue(':lastname', $user->getLastname());
        $q->bindValue(':email', $user->getEmail());
        $q->bindValue(':password', $user->getPassword());
        $q->bindValue(':createdAt', $user->getCreatedAt());

        $q->execute();
    }

    public function deleteUser(user $user){
        $this->bdd->exec('DELETE FROM users WHERE id = '.$user->getId());
    }

    public function getUser($id){
        $id = (int) $id;

        $q = $this->bdd->query('SELECT firstname, lastname FROM users WHERE id = '.$id);
        $donnees =  $q->fetch(\PDO::FETCH_ASSOC);
        return new user($donnees);
    }

    public function userExist($email){

        $q = $this->bdd->query("SELECT * FROM users WHERE email ='$email' ");
        $donnees =  $q->fetch(\PDO::FETCH_ASSOC);
        if($donnees){
            return new user($donnees);
        }


    }

    public function getUsers(){
        $users = [];

        $q = $this->bdd->query('SELECT id, firstname, lastname FROM users');

        while($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
            $users[] = new user($donnees);
        }
    }

    public function updateUser(user $user){
        $q = $this->bdd->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id');
        $q->bindValue(':firstname', $user->getFirstname());
        $q->bindValue(':lastname', $user->getLastname());
        $q->bindValue(':email', $user->getEmail());
        $q->bindValue(':password', $user->getPassword());
        $q->bindValue(':id', $user->getId());
        $q->execute();
    }

}