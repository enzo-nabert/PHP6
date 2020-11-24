<?php

require_once File::build_path(array('model','Model.php'));
class ModelUtilisateur extends Model
{
    private $login;
    private $nom;
    private $prenom;
    protected static $object = "utilisateur";
    protected static $primary = "login";

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

    public function save()
    {
        try {
            $sql = "INSERT INTO utilisateur VALUES('$this->login','$this->nom','$this->prenom')";
            $pdo = Model::$pdo;
            $req = $pdo->prepare($sql);
            $req->execute();
        }catch(PDOException $e){
            if ($e->getCode() == '23000'){
                return false;
            }
        }
        return true;
    }

}