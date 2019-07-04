<?php

namespace Entity;

class task{

    private $id;
    private $tache;
    private $createdAt;
    private $userId;

    public function __construct($donnees){
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)){

                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTache()
    {
        return $this->tache;
    }

    /**
     * @param mixed $tache
     */
    public function setTache($tache)
    {
        $this->tache = $tache;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public  function setUserId($userId){

        $this->userId = $userId;
    }

    public  function getUserId(){
        return $this->userId;
    }



}