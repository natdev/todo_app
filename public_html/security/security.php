<?php
namespace Security;

class security extends \connexion {

    public function verification($email,$password){
        $q = $this->bdd->prepare('SELECT id, lastname, firstname, password FROM users WHERE email = :email');
        $q->execute(array(
           'email' => $email
        ));

        $result = $q->fetch();

        $passwordVerif = password_verify($password, $result['password']);

        if(!$result){

            return false;
        }else{
            if($passwordVerif){
                echo $result['password'];
                $_SESSION['id'] = $result['id'];
                $_SESSION['lastname'] = $result['lastname'];
                $_SESSION['firstname'] = $result['firstname'];
                return true;
            }
            else{
                return false;
            }
        }
    }
}