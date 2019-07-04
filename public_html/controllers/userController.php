<?php

use Entity\user;
use Manager\userManager;
use Security\security;

class userController{
    public function registerAction($twig){
        $manageUser = new userManager();

        if($_POST){
            extract($_POST);
            if($_POST['submit']){

                if(empty($firstname)){
                    $error_firstname = "Ce champ ne peut pas être vide";

                }
                if(empty($lastname)){
                    $error_lastname = "Ce champ ne peut pas être vide";

                }
                if(!empty($email) && !preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$email)){
                    $error_email = "Cet email est incorrect";

                }
                if(empty($email)){
                    $error_email = "Ce champ ne peut pas être vide";
                }



                if(empty($password)){
                    $error_password = "Ce champ ne peut pas être vide";

                }

                if(!empty($password) && !empty($password_verif) && $password !== $password_verif){
                    $error_password = "Veuillez saisir des mots de passe similaire";
                }

                $userExist = $manageUser->userExist($email);

                if(!$userExist){
                    $createdAt = new DateTime();
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $user = new user([
                        'lastname' => htmlspecialchars($lastname),
                        'firstname'=> htmlspecialchars($firstname),
                        'email'    => htmlspecialchars($email),
                        'password' => htmlspecialchars($password),
                        'createdAt' => $createdAt->format('Y-m-d H:i:s')
                    ]);

                    $manager = new userManager();
                    $manager->addUser($user);

                    header('Location: /user/login');
                }
                else{
                    $error_email = "Cet utilisateur existe";
                }

            }




        }

        echo $twig->render('users/register.html.twig',[
            'error_firstname' => (isset($error_firstname)) ? $error_firstname : null,
            'error_lastname' => (isset($error_lastname)) ? $error_lastname : null,
            'error_email' => (isset($error_email)) ? $error_email : null,
            'error_password' => (isset($error_password)) ? $error_password : null,

        ]);
    }

    public function loginAction($twig){

        if($_POST){
            extract($_POST);

            if(!empty($email) && !preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$email)){
                $error_email = "Cet email est incorrect";

            }
            if(empty($email)){
                $error_email = "Ce champ ne peut pas être vide";
            }

            if(empty($password)){
                $error_password = "Ce champ ne peut pas être vide";

            }
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);
            $verification =  new security();
            $verify = $verification->verification($email, $password);

            if($verify){
                header('Location: /');
            }else{
                $error_verif = 'mauvais identifiant ou mauvais mot de passe';
            }





        }

        echo $twig->render('users/login.html.twig',[
            'error_email' => (isset($error_email)) ? $error_email : null,
            'error_password' => (isset($error_password)) ? $error_password : null,
            'error_verif' => (isset($error_verif)) ? $error_verif : null,
        ]);
    }

    public function logoutAction(){
        $_SESSION = array();

        session_destroy();

        header('Location: /');

    }
}