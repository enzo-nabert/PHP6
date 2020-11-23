<?php


class ModelUtilisateur
{
    private $login;
    private $nom;
    private $prenom;

    public function __construct($data = array())  {
        foreach ($data as $key => $value){
            if($key != 'action') {
                $this->$key = $value;
            }
        }
    }

    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut,$valeur){
        $this->$attribut = $valeur;
    }

    public static function getAllUtilisateurs(){
        $pdo = Model::$pdo;
        $rep = $pdo->query("SELECT * FROM utilisateur");
        $rep->setFetchMode(PDO::FETCH_CLASS,'ModelUtilisateur');
        return $rep->fetchAll();
    }

}