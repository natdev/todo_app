<?php



class connexion {

    protected $bdd;


    public function __construct()
    {
        try{
            $bdd = new PDO('mysql:host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPWD);

            return $this->bdd = $bdd;

        }catch(Exception $e){

            echo 'Exception reçue : '.$e->getMessage();
        }
    }

}